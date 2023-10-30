<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Estado;
use App\Enums\UserTypes;
use App\Models\Requisicion;
use App\Services\AsyncService;
use App\Contracts\UserInterface;
use App\Http\Requests\RequisicionRequest;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function App\responseError;

class RequisicionController
{
    private Estado $estado;
    private Requisicion $req;
    private RequisicionRequest $validator;
    private AsyncService $async;

    public function __construct(
        Estado $estado,
        Requisicion $req,
        AsyncService $asyncService,
        RequisicionRequest $validator
    ) {
        $this->req = $req;
        $this->estado = $estado;
        $this->async = $asyncService;
        $this->validator = $validator;
    }

    public function create(Request $request, UserInterface $user): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator->validateInsert($body);

            $new  = $this->req->save($data + [
                "jefe_id" => $user->getJefeId(),
                "area_id" => $user->getAreaId(),
                "usuario_id" => $user->getId()
            ]);

            $this->async->notificarCambioEstado($new);
            return new JsonResponse([
                "status" => true,
                "data" => $this->req->findBasic($new)
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function update(Request $request, int $id, UserInterface $user): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator->validateInsert($body);
            $this->req->save($data + [
                "usuario_id" => $user->getId()
            ], $id);

            $this->async->notificarCambioEstado($id);
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

    public function findSimilar(Request $request): Response
    {
        try {
            $x = @$request->getQueryParams()["x"] ?? "";
            return new JsonResponse($this->req->similar($x));
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function getTh(Request $request): Response
    {
        try {
            $_ = $request->getQueryParams()["state"] ?? "";

            return new JsonResponse([
                "data" => $this->req->getAll($_)
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function getAll(UserInterface $user): Response
    {
        try {
            if ($user->getUserType() === UserTypes::TH)
                return new JsonResponse($this->req->getTh());

            $jefe = $this->req->getJefe($user);

            if (in_array($user->getUserType(), [
                UserTypes::DIRECTOR,
                UserTypes::DIRECTOR_CIENTIFICO,
                UserTypes::DIRECTOR_ADMINISTRATIVO,
            ])) return new JsonResponse(array_unique(array_merge(
                    $this->req->getDirector($user),
                    $jefe),
                \SORT_REGULAR)
            );

            if ($user->getUserType() === UserTypes::GERENTE)
                return new JsonResponse(array_unique(array_merge(
                    $this->req->getGerencia($user),
                    $jefe),
                    \SORT_REGULAR)
                );

            return new JsonResponse($jefe);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function getDir(UserInterface $user): Response
    {
        try {
            return new JsonResponse([
                "data" => array_merge($this->req->getAll(
                    \App\Enums\Estados::APROBADO,
                    \App\Enums\UserTypes::TH,
                    $user->getUserType()
                ), $this->req->getAll(
                    "",
                    $user->getUserType()
                ))
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function getGerencia(UserInterface $user): Response
    {
        try {
            return new JsonResponse([
                "data" => array_merge($this->req->getAll(
                    \App\Enums\Estados::APROBADO,
                    \App\Enums\UserTypes::TH,
                    $user->getUserType()
                ), $this->req->getAll(
                    \App\Enums\Estados::APROBADO,
                    \App\Enums\UserTypes::DIRECTOR_CIENTIFICO,
                    ""
                ), $this->req->getAll(
                    \App\Enums\Estados::APROBADO,
                    \App\Enums\UserTypes::DIRECTOR_ADMINISTRATIVO,
                    ""
                ), $this->req->getAll(
                    "",
                    $user->getUserType()
                ))
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
                "data" => $this->req->getAll($_, "", "", $user->getJefeId())
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function updateTh(Request $request, int $id, UserInterface $user): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator->validataUpdateTh($body + [
                "usuario_id" => $user->getId()
            ]);
            $this->req->updateTh($id, $data);

            $this->async->notificarCambioEstado($id);
            return new JsonResponse([
                "status" => true,
                "__ctrl" => $this->req->findBasic($id)
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function updateState(Request $request, int $id, UserInterface $user): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];
            $data = $this->validator->validataUpdateState($body + [
                "by" => $user->getUserType(),
                "usuario_id" => $user->getId()
            ]);
            $this->estado->create($id, $data);

            $this->async->notificarCambioEstado($id);
            return new JsonResponse([
                "by"    => $data["by"],
                "state" => $data["state"],
                "state_at" => date("Y-m-d H:i:s"),
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
