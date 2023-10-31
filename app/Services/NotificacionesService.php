<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Enums\UserTypes;
use UltraMsg\WhatsAppApi;
use App\Models\Requisicion;
use App\Views;
use PHPMailer\PHPMailer\PHPMailer;
use Psr\Log\LoggerInterface;

class NotificacionesService
{
    private User $user;
    private Views $views;
    private WhatsAppApi $wp;
    private Requisicion $req;
    private PHPMailer $email;
    private LoggerInterface $logger;

    public function __construct(
        User $user,
        Views $views,
        WhatsAppApi $wp,
        Requisicion $req,
        PHPMailer $email,
        LoggerInterface $logger
    ) {
        $this->wp = $wp;
        $this->req = $req;
        $this->user = $user;
        $this->views = $views;
        $this->email = $email;
        $this->logger = $logger;
    }

    /**
     * Se encarga de notificar a los jefes de los cambios de estados de una
     * requisicion.
     *
     * @param int $reqId Requisicion
    */
    public function cambioEstado(int $reqId)
    {
        try {
            $req = $this->req->findNoty($reqId);

            if ($req === null) {
                throw new \Exception("Notificacion Error. No Requisicion.");
            }

            $contact = $this->user->getContactData((int) $req["jefe_id"]);
            $this->unsetContactsEstados($req, $contact);

            $email = $this->views->fetch("./notificaciones/correo.php", [
                "cargo"  => $req["cargo"],
                "estado" => $req["_state"],
                "f_req"  => $req["created_at"],
                "detail" => $req["detail"],
                "area"   =>  $req["area_nombre"],
                "f_estado"  =>  $req["state_at"]
            ]);
            $wpText = $this->views->fetch("./notificaciones/wp.php", [
                "cargo"  => $req["cargo"],
                "detail" => $req["detail"],
                "estado" => $req["_state"],
                "f_req"  => $req["created_at"],
                "area"   =>  $req["area_nombre"],
                "f_estado"  =>  $req["state_at"],
            ]);

            $this->send( $contact, $wpText, $email );
            $this->logger->info("Notificaciones enviadas: Requisicion $reqId");
        } catch(\Exception $e) {
            $this->logger->error("Notificaciones: " . $e->getMessage());
        }
    }

    /**
     * Se encarga de notificar a los jefes cuando se realiza una observacion a
     * la requisicion.
     *
     * @param int $reqId Requisicion
    */
    public function observaciones(int $obsId)
    {
        try {
            $obs = (new \App\Models\Observacion($this->req->db))
                ->findNoty($obsId);

            if ($obs === null) {
                throw new \Exception("Notificacion Error. No Observacion.");
            }

            $contact = $this->user->getContactData(0);
            $this->unsetContactsEstados($obs, $contact);

            $wpText = $this->views->fetch("./notificaciones/observacion-wp.php", [
                "id"   => $obs["id"],
                "body" => $obs["body"],
                "cargo"  => $obs["cargo"],
                "req_id" => $obs["req_id"],
                "author" =>  $obs["author"],
                "created_at"  => $obs["created_at"]
            ]);

            $this->send( $contact, $wpText );
            $this->logger->info("Notificaciones enviadas: Observacion $obsId");
        } catch(\Exception $e) {
            $this->logger->error("Notificaciones: " . $e->getMessage());
        }
    }

    /**
     * Realiza el envio de los correos y mensajes de Whatsapp.
     *
     * @param array $contact Informacion de contacto de los jefes
     * @param string $wpText Mensaje que se enviara por Whatsapp.
     * @param string $email HTML que se enviara por correo.
    */
    private function send(array $contact, string $wpText, ?string $email = null): void
    {
        try {
            $this->wp->sendChatMessage("3209353216", $wpText, 5);
            foreach($contact as $tipo => $info) {
                // $this->wp->sendChatMessage($info["tel"], $wpText, 5);
                $this->email->addAddress($info["email"]);
            }

            if ($email === null) return;

            $this->email->isHTML(true);
            $this->email->Body = $email;
            $this->email->Subject = "Requisición de Personal";
            $this->email->AltBody = preg_replace("#[*_`]#", "", $wpText);
            $this->email->send();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Remueve del array de informacion de contacto a los usuarios que no
     * necesitan ser informados del cambio realizado.
     *
     * @param array $req Informacion de la requisicion.
     * @param array $contact Informacion de contacto (telefono y correo). Esta
     *                  variable se pasa por referencia, asi que su contenido
     *                  se altera dentro de la funcion.
    */
    private function unsetContactsEstados(array $req, array &$contact)
    {
        unset($contact[$req["by"]]);

        if ($req["by"] === UserTypes::JEFE) {
            unset(
                $contact[ UserTypes::GERENTE ],
                $contact[ UserTypes::DIRECTOR_CIENTIFICO ],
                $contact[ UserTypes::DIRECTOR_ADMINISTRATIVO ]
            );
            return;
        }

        if ($req["by"] === UserTypes::TH || $req["by"] === UserTypes::GERENTE) {
            if ($req["director"] != UserTypes::GERENTE) {
                $dir = ($req["director"] === UserTypes::DIRECTOR_CIENTIFICO)
                    ? UserTypes::DIRECTOR_ADMINISTRATIVO
                    : UserTypes::DIRECTOR_CIENTIFICO;

                unset($contact[$dir]);
                return;
            }
        }

        unset(
            $contact[ UserTypes::DIRECTOR_CIENTIFICO ],
            $contact[ UserTypes::DIRECTOR_ADMINISTRATIVO ]
        );
    }
}
