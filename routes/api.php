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
            $req->get("/get", [RequisicionController::class, "getAll"]);
            $req->get("/get-th", [RequisicionController::class, "getTh"]);
            $req->get("/get-dir", [RequisicionController::class, "getDir"]);
            $req->get("/get-gerencia", [RequisicionController::class, "getGerencia"]);
            $req->get("/get-jefe", [RequisicionController::class, "getJefe"]);
            $req->post("/create", [RequisicionController::class, "create"]);

            $req->put("/{id:[0-9]+}/update", [RequisicionController::class, "update"]);
            $req->put("/{id:[0-9]+}/update-th", [RequisicionController::class, "updateTh"]);
            $req->put("/{id:[0-9]+}/update-state", [RequisicionController::class, "updateState"]);
        });

        $api->group("/observacion", function(Group $obs) {
            // $obs->get("/{reqId:[0-9]+}/getall", [ObservacionController::class, "getAll"]);
            $obs->get("/{id:[0-9]+}/getall", [RequisicionController::class, "observaciones"]);
            $obs->post("/{reqId:[0-9]+}/create", [ObservacionController::class, "create"]);
        });

        $api->group("/get", function(Group $extra) {
            $extra->get("/areas", [ExtraController::class, "areas"]);
            $extra->get("/meta", [ExtraController::class, "getMetaInfo"]);
        });

        $api->get("/auth/info", [ExtraController::class, "getAuthInfo"]);
    })->add(JsonBodyParserMiddleware::class);
}

