<?php
declare(strict_types=1);

use Slim\Routing\RouteCollectorProxy as Group;
use App\Http\Controllers\ViewController;

/**
 * Carga las rutas web...
*/
function loadWebRoutes(\Slim\App $app) {
    $app->group("", function(Group $app) {
        $app->get("/", [ViewController::class, "jefes"])
            ->setName("req.jefes");
        $app->get("/control", [ViewController::class, "control"])
            ->setName("req.control");
        $app->get("/th", [ViewController::class, "th"])
            ->setName("req.th");
        $app->get("/direccion", [ViewController::class, "dir"])
            ->setName("req.dir");
        $app->get("/gerencia", [ViewController::class, "gerencia"])
            ->setName("req.gerencia");
    })->add(\App\Http\Middleware\SetRouteContextMiddleware::class);
}
