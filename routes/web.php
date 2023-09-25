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
        $app->get("/th", [ViewController::class, "th"])
            ->setName("req.th");
        $app->get("/direccion", [ViewController::class, "dir"])
            ->setName("req.dir");
    })->add(\App\Http\Middleware\SetRouteContextMiddleware::class);
}
