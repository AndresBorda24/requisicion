<?php
declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy as Group;
use App\Http\Middleware\JsonBodyParserMiddleware;
use App\Http\Controllers\Api\RequisicionController;

function loadApiRoutes(App $app): void {
    $app->group("/api", function(Group $api) {
        $api->group("/requisicion", function(Group $req) {
            $req->post("/create", [RequisicionController::class, "create"]);
        });
    })->add(JsonBodyParserMiddleware::class);
}

