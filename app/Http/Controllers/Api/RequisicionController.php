<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

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

    public function create(Request $request): Response
    {
        try {
            $body = $request->getParsedBody() || [];
            $data = $this->validator
                ->validateInsert($body + ["jefe_id" => 12]);

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
}
