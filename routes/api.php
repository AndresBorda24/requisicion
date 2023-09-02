<?php
declare(strict_types=1);

use App\Http\Controllers\Api\ExtraController;
use Slim\App;
use App\Http\Controllers\Api\ObservacionController;
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

        $api->group("/observacion", function(Group $obs) {
            $obs->get("/{reqId:[0-9]+}/getall", [ObservacionController::class, "getAll"]);
            $obs->post("/{reqId:[0-9]+}/create", [ObservacionController::class, "create"]);
        });

        $api->group("/get", function(Group $extra) {
            $extra->get("/areas", [ExtraController::class, "areas"]);
        });
    })->add(JsonBodyParserMiddleware::class);
}

