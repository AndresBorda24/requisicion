<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Observacion;
use App\Contracts\UserInterface;
use App\Services\AsyncService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function \App\responseError;

class ObservacionController
{
    private Observacion $obs;
    private AsyncService $async;

    public function __construct(Observacion $obs, AsyncService $async)
    {
        $this->obs = $obs;
        $this->async = $async;
    }

    public function create(Request $request, UserInterface $user, int $reqId): Response
    {
        try {
            $body = $request->getParsedBody() ?? [];

            if (! array_key_exists("body", $body)) {
                throw new \Exception("No body...");
            }

            $new = $this->obs->create($body + [
                "req_id" => $reqId,
                "quien"  => $user->getId()
            ]);

            $this->async->notificarObervacion($new);
            return new JsonResponse([
                "status" => true,
                "new"    => $this->obs->find($new)
            ]);
        } catch(\Exception $e) {
            return responseError($e);
        }
    }

    public function getAll(int $reqId): Response
    {
        try {
            return new JsonResponse($this->obs->getAll($reqId));
        } catch(\Exception $e) {
            return responseError($e);
        }
    }
}
