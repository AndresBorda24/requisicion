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

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                pclose(
                    popen(sprintf("start /B wget --method=POST -q -O - %s",
                        escapeshellarg($url)
                    ), "r")
                );
            } else {
                shell_exec(sprintf("wget --method=POST -O last -q -b %s",
                    escapeshellarg($url)
                ));
            }
        } catch(\Exception $e) {
            // Implementar. Podria ser simplemente el log a un archivo.
        }
    }
}
