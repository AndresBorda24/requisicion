<?php
declare(strict_types=1);

namespace App;

use App\Models\User;
use App\Contracts\UserInterface;

class Auth
{
    private User $userDb;
    private Session $session;
    private ?UserInterface $user = null;

    public function __construct(Session $session, User $userDb)
    {
        $this->userDb = $userDb;
        $this->session = $session;
    }

    /**
     * Retorna el usuario que esta actualmente loggeado
    */
    public function user(): ?UserInterface
    {
        if($this->user !== null) {
            return $this->user;
        }

        /**
         * 38  -> Gerente Botero
         * 476 -> Director Administrativo Financiero
         * 51  -> Director cientifico.
         * 675 -> Jefe Talento Humano
        */
        $id = $this->session->get("usu_id", 136); // 617 // 675 // 476 // 136
        if(! $id) return null;

        $this->user = $this->userDb->find((int) $id);
        return $this->user;
    }
}
