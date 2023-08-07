<?php
declare(strict_types = 1);

namespace App\Http\Middleware;

use App\Auth;
use Laminas\Diactoros\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    private Auth $auth;
    private ContainerInterface $config;

    public function __construct(
        Auth $auth,
        ContainerInterface $config
    ) {
        $this->auth = $auth;
        $this->config = $config;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        if ($user = $this->auth->user()) {
            return $handler->handle($request->withAttribute('user', $user));
        }

        $response = new Response(302);
        return $response->withHeader(
            'Location',
            'https://intranet.asotrauma.com.co/iniciosesion.php?ruta=' .
            $this->config->get("app.path")
        );
    }
}
