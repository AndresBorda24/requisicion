<?php
declare(strict_types=1);

use Medoo\Medoo;
use DI\ContainerBuilder;
use Katzgrau\KLogger\Logger;
use PHPMailer\PHPMailer\PHPMailer;
use UltraMsg\WhatsAppApi;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

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
    ]),
    WhatsAppApi::class => fn(ContainerInterface $c) => new WhatsAppApi(
        $c->get('wp.token'),
        $c->get('wp.instance')
    ),
    PHPMailer::class => function (ContainerInterface $c) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug  = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
        $mail->Host       = $c->get("mail.host");
        $mail->Port       = $c->get("mail.port");
        $mail->CharSet    = "UTF-8";
        $mail->SMTPAuth   = true;
        $mail->Username   = $c->get("mail.username");
        $mail->Password   = $c->get("mail.password");
        $mail->SMTPSecure = $c->get("mail.encription");

        return $mail;
    },
    LoggerInterface::class => fn() => new Logger(__DIR__."/../logs")
]);

return $builder->build();
