<?php
declare(strict_types=1);

use App\Http\Controllers\ViewController;

/**
 * Carga las rutas web...
*/
function loadWebRoutes(\Slim\App $app) {
    $app->get("/", [ViewController::class, "jefes"]);
}
