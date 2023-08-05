<?php
declare(strict_types=1);

use App\Views;
use DI\ContainerBuilder;
use Medoo\Medoo;
use Psr\Container\ContainerInterface;

$builder  = new ContainerBuilder;

$builder->addDefinitions(__DIR__ . "/app.php");
$builder->addDefinitions([
    Medoo::class => fn(ContainerInterface $c) => new Medoo([
        'type' => $c->get('db.type'),
        'host' => $c->get('db.host'),
        'port' => $c->get('db.port'),
        'database'  => $c->get('db.name'),
        'username'  => $c->get('db.user'),
        'password'  => $c->get('db.pass'),
        'collation' => 'utf8mb4_general_ci',
    ])
]);

return $builder->build();
