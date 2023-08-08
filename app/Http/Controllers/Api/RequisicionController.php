<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\UserInterface;
use App\Models\Requisicion;
use App\Http\Requests\RequisicionRequest;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function App\responseError;

class RequisicionController
{
    private Requisicion $req;
    private RequisicionRequest $validator;

    public function __construct(Requisicion $req, RequisicionRequest $validator)
    {
        $this->req = $req;
        $this->validator = $validator;
    }

    public function create(Request $request, UserInterface $user): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator
                ->validateInsert($body + [
                    "jefe_id" => $user->getJefeId(),
                    "area_id" => $user->getAreaId()
                ]);

            return new JsonResponse([
                "status" => true,
                "data" => $this->req->find(
                    $this->req->create($data)
                )
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function getTh(Request $request): Response
    {
        try {
            $_ = $request->getQueryParams()["state"] ?? "";

            return new JsonResponse([
                "status" => true,
                "data" => $this->req->getAll($_)
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function getJefe(Request $request, UserInterface $user): Response
    {
        try {
            $_ = $request->getQueryParams()["state"] ?? "";

            return new JsonResponse([
                "status" => true,
                "data" => $this->req->getAll($_, $user->getJefeId())
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }
}
