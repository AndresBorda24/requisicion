<?php
declare(strict_types=1);

namespace App\Services;

use Slim\App;
use Psr\Log\LoggerInterface;
use Psr\Container\ContainerInterface;
use Slim\Interfaces\RouteParserInterface;

class AsyncService
{
    private ContainerInterface $c;
    private LoggerInterface $logger;
    private RouteParserInterface $rutas;

    public function __construct(
        App $app,
        ContainerInterface $c,
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

            $this->call($url);
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

            $this->call($url);
        } catch(\Exception $e) {
            $this->logger->error("Async Error Obs: " . $e->getMessage());
        }
    }

    /**
     * Realiza la llamada HTTP de forma asyncrona.
     *
     * @param string $url
    */
    public function call(string $url): void
    {
        try {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                pclose(
                    popen(sprintf("start /B wget -O NUL --method=POST --quiet -b %s",
                        escapeshellarg($url)
                    ), "r")
                );
            } else {
                shell_exec(sprintf("wget --post-data=\"\" -q -b -O - %s",
                    escapeshellarg($url)
                ));
            }
        } catch(\Exception $e) {
            $this->logger->error("Async Error Obs: " . $e->getMessage());
        }
    }
}
