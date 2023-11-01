<?php
declare(strict_types = 1);

namespace App\Http\Middleware;

use Slim\App;
use App\Auth;
use App\Enums\UserTypes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Interfaces\RouteParserInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\EmptyResponse;

class NoJefeMiddleware implements MiddlewareInterface
{
    private Auth $auth;
    private RouteParserInterface $router;

    public function __construct(
        App $app,
        Auth $auth
    ) {
        $this->auth = $auth;
        $this->router = $app->getRouteCollector()->getRouteParser();
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $user = $this->auth->user();

        if (
            $user->getUserType() !== UserTypes::JEFE
            || $user->getAreaId() == 20 // Si el jefe es de sistemas
        ) {
            return $handler->handle($request);
        }

        $response = new EmptyResponse(302);
        $home = $this->router->urlFor("req.jefes");
        return $response->withHeader('Location', $home);
    }
}
