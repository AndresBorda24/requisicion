<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Observacion;
use App\Contracts\UserInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function \App\responseError;

class ObservacionController
{
    private Observacion $obs;

    public function __construct(Observacion $obs)
    {
        $this->obs = $obs;
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
