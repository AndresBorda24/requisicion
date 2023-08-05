<?php
declare(strict_types=1);

/**
 * Carga las rutas web...
*/
function loadWebRoutes(\Slim\App $app) {
    $app->get("/", function ($response) {
        $response->getBody()->write("Hello world!");
        return $response;
    });
}
