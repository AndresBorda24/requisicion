<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Db;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;

use function App\responseError;

class ExtraController
{
    private Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function areas(): Response
    {
        try {
            return new JsonResponse($this->db->getAreas());
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    /**  @param \App\Contracts\UserInterface $user */
    public function getAuthInfo($user): Response
    {
        try {
            return new JsonResponse([
                "id"    => $user->getId(),
                "cargo" => $user->getCargoId(),
                "area"  => $user->getAreaId(),
                "jefe"  => $user->getJefeId(),
                "tipo"  => $user->getUserType(),
                "nombre" => $user->getNombre(),
            ]);
        } catch (\Exception $e) {
            return responseError($e);
        }
    }

    /**  @param \App\Contracts\UserInterface $user */
    public function getMetaInfo(): Response
    {
        try {
            return new JsonResponse([
                "estados" => \App\Enums\Estados::cases(),
                "u_tipos" => \App\Enums\UserTypes::cases()
            ]);
        } catch (\Exception $e) {
            return responseError($e);
        }
    }
}
