<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Db;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
}
