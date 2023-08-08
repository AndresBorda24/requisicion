<?php
declare(strict_types=1);

namespace App;

use Medoo\Medoo;
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

        $id = $this->session->get("usu_id", 133); // 133 // 617
        if(! $id) return null;

        $this->user = $this->userDb->find((int) $id);
        return $this->user;
    }
}
