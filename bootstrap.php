<?php
declare(strict_types=1);

// Cargamos las variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/** @var \Psr\Container\ContainerInterface */
$container = require __DIR__ . '/config/container.php';
$app = \DI\Bridge\Slim\Bridge::create($container);

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, true);

$app->add(\App\Http\Middleware\AuthMiddleware::class);
$app->add(\App\Http\Middleware\StartSessionMiddleware::class);
$app->setBasePath($container->get("app.path"));

// Devolvemos app
return $app;
