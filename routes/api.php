<?php
declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy as Group;
use App\Http\Middleware\JsonBodyParserMiddleware;
use App\Http\Controllers\Api\RequisicionController;

function loadApiRoutes(App $app): void {
    $app->group("/api", function(Group $api) {
        $api->group("/requisicion", function(Group $req) {
            $req->get("/{id:[0-9]+}/get", [RequisicionController::class, "find"]);
            $req->get("/get-th", [RequisicionController::class, "getTh"]);
            $req->get("/get-jefe", [RequisicionController::class, "getJefe"]);
            $req->post("/create", [RequisicionController::class, "create"]);

            $req->put("/{id:[0-9]+}/update-th", [RequisicionController::class, "updateTh"]);
        });
    })->add(JsonBodyParserMiddleware::class);
}

