<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Services\NotificacionesService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;

class NotificacionController
{
    public function __invoke(
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
