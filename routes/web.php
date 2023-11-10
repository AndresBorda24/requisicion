<?php
declare(strict_types=1);

use App\Http\Controllers\ViewController;
use App\Http\Middleware\NoJefeMiddleware;
use Slim\Routing\RouteCollectorProxy as Group;

/**
 * Carga las rutas web...
*/
function loadWebRoutes(\Slim\App $app) {
    $app->group("", function(Group $app) {
        $app->get("/", [ViewController::class, "jefes"])
            ->setName("req.jefes");
        $app->get("/control", [ViewController::class, "control"])
            ->setName("req.control")
            ->add(NoJefeMiddleware::class);
        $app->get("/th", [ViewController::class, "th"])
            ->setName("req.th");
    })->add(\App\Http\Middleware\SetRouteContextMiddleware::class)
    ->add(\App\Http\Middleware\AuthMiddleware::class);
}
