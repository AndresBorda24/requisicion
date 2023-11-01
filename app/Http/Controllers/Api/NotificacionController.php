<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Services\NotificacionesService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;

class NotificacionController
{
    private NotificacionesService $not;

    public function __construct(
        NotificacionesService $not
    ) {
        $this->not = $not;
    }

    /** @param int $id ID de la observacion */
    public function observacion(
        int $id,
        NotificacionesService $not
    ): Response
    {
        try {
            $not->observaciones($id);
            return new JsonResponse(true);
        } catch(\Exception $e) {
            return new JsonResponse(false);
        }
    }

    public function cambioEstado(
        int $id,
        NotificacionesService $not
    ): Response
    {
        try {
            $not->cambioEstado($id);
            return new JsonResponse(true);
        } catch(\Exception $e) {
            return new JsonResponse(false);
        }
    }
}
