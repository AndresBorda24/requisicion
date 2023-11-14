<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Requisicion;
use Laminas\Diactoros\Stream;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;

class ExcelController
{
    private Requisicion $req;

    public function __construct(Requisicion $req)
    {
        $this->req = $req;
    }

    public function __invoke(Response $response)
    {
        try {
            $data = $this->req->excel();
            $name = "requisciones_".time().".xlsx";
            SimpleExcelWriter::create($name)->addRows($data);
            $stream = new Stream(fopen($name, "rb"));

            $response = $response->withBody($stream)
                ->withHeader('Content-Disposition', "inline; filename=$name;")
                ->withHeader('Content-Type', mime_content_type($name))
                ->withHeader('Content-Length', filesize($name));

            // Eliminamos el archivo pues no es de ninguna necesidad
            unlink($name);
            return $response;
        } catch(\Exception $e) {
            return new JsonResponse([
                "error" => $e->getMessage()
            ]);
        }
    }
}
