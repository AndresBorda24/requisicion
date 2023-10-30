<?php
declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Slim\App;
use Psr\Container\ContainerInterface;
use Slim\Interfaces\RouteParserInterface;

class AsyncService
{
    private ContainerInterface $c;
    private RouteParserInterface $rutas;

    public function __construct(ContainerInterface $c, App $app)
    {
        $this->c = $c;
        $this->rutas = $app->getRouteCollector()->getRouteParser();
    }

    /**
     * Genera una solicitud HTTP al endpoint para notificar los cambios de
     * estado en las requisiciones. No espera por la `response`.
     *
     * @return void No retorna nada.
    */
    public function notificarCambioEstado(int $id): void
    {
        try {
            $url = $this->c->get("base.url") . $this->rutas
                ->urlFor("noty.estado", ["id" => $id]);

            $cmd = "curl -X POST $url &";
            shell_exec($cmd);
            // $ch = curl_init();

            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_HEADER, 0);
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
            // curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200);
            // // curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1);
            // curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // curl_exec($ch);
            // curl_close($ch);
        } catch(\Exception $e) {
            // Implementar. Podria ser simplemente el log a un archivo.
        }
    }
}
