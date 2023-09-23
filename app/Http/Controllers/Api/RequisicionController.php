<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Requisicion;
use App\Contracts\UserInterface;
use App\Http\Requests\RequisicionRequest;
use App\Models\Estado;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function App\responseError;

class RequisicionController
{
    private Estado $estado;
    private Requisicion $req;
    private RequisicionRequest $validator;

    public function __construct(
        Estado $estado,
        Requisicion $req,
        RequisicionRequest $validator
    ) {
        $this->req = $req;
        $this->estado = $estado;
        $this->validator = $validator;
    }

    public function create(Request $request, UserInterface $user): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator->validateInsert($body);

            $new  = $this->req->save($data + [
                "jefe_id" => $user->getJefeId(),
                "area_id" => $user->getAreaId()
            ]);

            return new JsonResponse([
                "status" => true,
                "data" => $this->req->findBasic($new)
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function update(Request $request, int $id): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator->validateInsert($body);
            $this->req->save($data, $id);

            return new JsonResponse([
                "status" => true,
                "data" => $this->req->findBasic($id)
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }


    public function find(int $id): Response
    {
        try {
            return new JsonResponse([
                "status" => true,
                "data" => $this->req->find($id)
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

    public function updateTh(Request $request, int $id): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator->validataUpdateTh($body);
            $this->req->updateTh($id, $data);

            return new JsonResponse([
                "status" => true,
                "__ctrl" => $this->req->findBasic($id)
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function updateState(Request $request, int $id): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator->validataUpdateState($body);
            $this->estado->create($id, $data);

            return new JsonResponse([
                "by"    => $data["by"],
                "state" => $data["state"],
                "_state" => sprintf("%s por %s",
                    \App\Enums\Estados::value($data["state"]),
                    \App\Enums\UserTypes::value($data["by"])
                )
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function observaciones(int $id): Response
    {
        try {
            // return new JsonResponse($this->req->getObservaciones($id));
            return new JsonResponse($this->req->getAllObs($id));
        } catch(\Exception $e) {
            return responseError($e);
        }
    }
}
