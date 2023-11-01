<?php
declare(strict_types=1);

namespace App\Services;

use Slim\App;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Interfaces\RouteParserInterface;

class AsyncService
{
    private ContainerInterface $c;
    private LoggerInterface $logger;
    private RouteParserInterface $rutas;

    public function __construct(
        ContainerInterface $c,
        App $app,
        LoggerInterface $logger
    ) {
        $this->c = $c;
        $this->rutas = $app->getRouteCollector()->getRouteParser();
        $this->logger = $logger;
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
                    popen(sprintf("start /B wget --post-data -O - -q -b %s",
                        escapeshellarg($url)
                    ), "r")
                );
            } else {
                shell_exec(sprintf("wget --post-data -O - -q -b %s",
                    escapeshellarg($url)
                ));
            }
        } catch(\Exception $e) {
            $this->logger->error("Async Error: " . $e->getMessage());
        }
    }

    /**
     * Genera una solicitud HTTP al endpoint para notificar los cambios de
     * estado en las requisiciones. No espera por la `response`.
     *
     * @param int $id ID de la observacion
     * @return void No retorna nada.
    */
    public function notificarObervacion(int $id): void
    {
        try {
            $url = $this->c->get("base.url") . $this->rutas
                ->urlFor("noty.obs", ["id" => $id]);

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                pclose(
                    popen(sprintf("start /B wget --post-data -O - -q -b %s",
                        escapeshellarg($url)
                    ), "r")
                );
            } else {
                shell_exec(sprintf("wget --post-data -O - -q -b %s",
                    escapeshellarg($url)
                ));
            }
        } catch(\Exception $e) {
            $this->logger->error("Async Error Obs: " . $e->getMessage());
        }
    }
}
