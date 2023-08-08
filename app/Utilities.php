<?php
declare(strict_types=1);

namespace App;

use Laminas\Diactoros\Response\JsonResponse;
use App\Http\Requests\Exceptions\RequestException;
use Psr\Http\Message\ResponseInterface as Response;

if (! function_exists('App\trimUtf8')) {
    /**
     * Convierte el texto en utf8 y quita los espacios en blanco
    */
    function trimUtf8(string $str): string
    {
        return trim(
            mb_convert_encoding($str, 'UTF-8')
        );
    }
}

if (! function_exists('App\responseError')) {
    /**
     *  Helper para retornar una respuesta de error y que esta pueda
     * deberse a un error del body del request
    */
    function responseError(\Exception $e): Response
    {
        $data =  [
            "status" => false,
            "error"  => $e->getMessage(),
        ];

        if ($e instanceof RequestException) {
            $data["fields"] = $e->getErrors();
        }

        return new JsonResponse($data, 422);
    }
}
