<?php
declare(strict_types = 1);

namespace App\Http\Middleware;

use App\Auth;
use App\Session;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\EmptyResponse;

class AuthMiddleware implements MiddlewareInterface
{
    private Auth $auth;
    private Session $session;
    private ContainerInterface $config;

    public function __construct(
        Auth $auth,
        Session $session,
        ContainerInterface $config
    ) {
        $this->auth = $auth;
        $this->config = $config;
        $this->session = $session;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $user = $this->auth->user();

        if ($this->session->get("usu_id") && ! $user) {
            return (new EmptyResponse(302))->withHeader(
                'Location',
                'https://intranet.asotrauma.com.co/indexloginadmin.php'
            );
        }

        if ($user) {
            return $handler->handle($request->withAttribute('user', $user));
        }

        $response = new EmptyResponse(302);
        return $response->withHeader(
            'Location',
            'https://intranet.asotrauma.com.co/iniciosesion.php?ruta=' .
            $this->config->get("app.path")
        );
    }
}
