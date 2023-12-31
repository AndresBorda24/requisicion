<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../routes/web.php';
require __DIR__ . '/../routes/api.php';

/** @var \Slim\App */
$app = require __DIR__ . '/../bootstrap.php';
loadWebRoutes($app);
loadApiRoutes($app);

$app->run();
