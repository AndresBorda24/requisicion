<?php
declare(strict_types=1);

return [
    "app.name" => $_ENV["APP_NAME"] ?? "Mi app",
    "app.path" => $_ENV["APP_BASE"] ?? "",
    "app.url"  => $_ENV["APP_URL"] ?? "localhost",
    "app.api"  => $_ENV["APP_API"] ?? "localhost/api",
    "app.ver"  => $_ENV["APP_VER"] ?? "0.0.0",
    "base.url" => $_ENV["BASE_URL"] ?? "localhost",

    "app.templates"   => __DIR__ . '/..' . $_ENV["TEMPLATES"] ?? "/templates",
    "app.entrypoints" => __DIR__ . '/..' . $_ENV["ENTRYPOINTS_PATH"] ?? "/public",

    "db.host" => $_ENV["DB_HOST"] ?? "localhost",
    "db.type" => $_ENV["DB_TYPE"] ?? "mysql",
    "db.user" => $_ENV["DB_USER"] ?? "root",
    "db.port" => $_ENV["DB_PORT"] ?? 3306,
    "db.pass" => $_ENV["DB_PASS"] ?? "",
    "db.name" => $_ENV["DB_NAME"] ?? "mi_app",

    "mail.mailer"   =>  $_ENV["MAIL_MAILER"] ?? "",
    "mail.host"     =>  $_ENV["MAIL_HOST"] ?? "",
    "mail.port"     =>  $_ENV["MAIL_PORT"] ?? "",
    "mail.username" =>  $_ENV["MAIL_USERNAME"] ?? "",
    "mail.password" =>  $_ENV["MAIL_PASSWORD"] ?? "",
    "mail.encription" =>  $_ENV["MAIL_ENCRYPTION"] ?? "",

    "wp.token" => $_ENV["WP_TOKEN"] ?? "",
    "wp.instance" => $_ENV["WP_INSTANCE"] ?? "",
];
