<?php
declare(strict_types=1);

// Cargamos las variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/** @var \Psr\Container\ContainerInterface */
$container = require __DIR__ . '/config/container.php';
$app = \DI\Bridge\Slim\Bridge::create($container);
$app->setBasePath($container->get("app.path"));

// Devolvemos app
return $app;
