<?php
declare(strict_types=1);

use function DI\env;

return [
    "app.name" => env("APP_NAME", "Mi app"),
    "app.path" => env("APP_BASE", ""),
    "app.url"  => env("APP_URL", "localhost"),
    "app.api"  => env("APP_API", "localhost/api"),

    "app.templates"   => env("TEMPLATES", "/templates"),
    "app.entrypoints" => env("ENTRYPOINTS_PATH", "/public"),

    "db.host" => env("DB_HOST", "localhost"),
    "db.type" => env("DB_TYPE", "mysql"),
    "db.user" => env("DB_USER", "root"),
    "db.port" => env("DB_PORT", 3306),
    "db.pass" => env("DB_PASS", ""),
    "db.name" => env("DB_NAME", "mi_app"),
];
