<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Enums\UserTypes;
use UltraMsg\WhatsAppApi;
use App\Models\Requisicion;
use App\Views;
use PHPMailer\PHPMailer\PHPMailer;

class NotificacionesService
{
    private User $user;
    private Views $views;
    private WhatsAppApi $wp;
    private Requisicion $req;
    private PHPMailer $email;

    public function __construct(
        User $user,
        Views $views,
        WhatsAppApi $wp,
        Requisicion $req,
        PHPMailer $email
    ) {
        $this->wp = $wp;
        $this->req = $req;
        $this->user = $user;
        $this->views = $views;
        $this->email = $email;
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
            ]);;

            $this->send( $contact, $wpText, $email );
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Realiza el envio de los correos y mensajes de Whatsapp.
     *
     * @param array $contact Informacion de contacto de los jefes
     * @param string $wpText Mensaje que se enviara por Whatsapp.
     * @param string $email HTML que se enviara por correo.
    */
    private function send(array $contact, string $wpText, string $email): void
    {
        $this->wp->sendChatMessage("3209353216", $wpText, 5);
        foreach($contact as $tipo => $info) {
            // $this->wp->sendChatMessage($info["tel"], $wpText, 5);
            $this->email->addAddress($info["email"]);
        }

        $this->email->isHTML(true);
        $this->email->Subject = "Requisición de Personal";
        $this->email->Body = $email;
        $this->email->AltBody = preg_replace("#[*_]#", "", $wpText);
        $this->email->send();

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
            $dir = ($req["director"] === UserTypes::DIRECTOR_CIENTIFICO)
                ? UserTypes::DIRECTOR_ADMINISTRATIVO
                : UserTypes::DIRECTOR_CIENTIFICO;

            unset($contact[$dir]);
            return;
        }

        unset(
            $contact[ UserTypes::DIRECTOR_CIENTIFICO ],
            $contact[ UserTypes::DIRECTOR_ADMINISTRATIVO ]
        );
    }
}
