<?php
declare(strict_types=1);

return [
    "app.name" => $_ENV["APP_NAME"] ?? "Mi app",
    "app.path" => $_ENV["APP_BASE"] ?? "",
    "app.url"  => $_ENV["APP_URL"] ?? "localhost",
    "app.api"  => $_ENV["APP_API"] ?? "localhost/api",
    "app.ver"  => $_ENV["APP_VER"] ?? "0.0.0",

    "app.templates"   => __DIR__ . '/..' . $_ENV["TEMPLATES"] ?? "/templates",
    "app.entrypoints" => __DIR__ . '/..' . $_ENV["ENTRYPOINTS_PATH"] ?? "/public",

    "db.host" => $_ENV["DB_HOST"] ?? "localhost",
    "db.type" => $_ENV["DB_TYPE"] ?? "mysql",
    "db.user" => $_ENV["DB_USER"] ?? "root",
    "db.port" => $_ENV["DB_PORT"] ?? 3306,
    "db.pass" => $_ENV["DB_PASS"] ?? "",
    "db.name" => $_ENV["DB_NAME"] ?? "mi_app",
];
