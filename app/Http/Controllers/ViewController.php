<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\UserInterface;
use App\Views;
use Psr\Http\Message\ResponseInterface as Response;

class ViewController
{
    private Views $views;

    public function __construct(Views $views)
    {
        $this->views = $views;
    }

    /**
     * Carga la vista para las solicitudes de TH
    */
    public function th(Response $response, UserInterface $user): Response
    {
        $this->views->addAttribute("user", $user);
        return $this->views->render($response, "th/index.php");
    }

    /**
     * Grilla para las jefes de direccion, cientifica y financiera.
    */
    public function dir(Response $response, UserInterface $user): Response
    {
        $this->views->addAttribute("user", $user);
        return $this->views->render($response, "direccion/index.php");
    }

    public function gerencia(Response $response, UserInterface $user): Response
    {
        $this->views->addAttribute("user", $user);
        return $this->views->render($response, "gerencia/index.php");
    }

    /**
     * Carga la vista para las solicitudes de TH
    */
    public function jefes(Response $response, UserInterface $user): Response
    {
        $this->views->addAttribute("user", $user);
        return $this->views->render($response, "jefes/index.php");
    }

    /**
     * En esta vista se muestran todas las requisiciones pero si permitir
     * ninguna accion CRUD
    */
    public function control(Response $response, UserInterface $user): Response
    {
        $this->views->addAttribute("user", $user);
        return $this->views->render($response, "control/index.php");
    }
}
