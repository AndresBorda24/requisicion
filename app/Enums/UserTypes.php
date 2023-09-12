<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa un Enum para los motivos de requisicion.
*/
final class UserTypes extends Enum
{
    public const JEFE     = "JF";
    public const TH       = "TH";
    public const DIRECTOR = "DR";
    public const GERENTE  = "GT";

    protected static array $values = [
        self::JEFE      => "Jefe",
        self::TH        => "Talento Humano",
        self::DIRECTOR  => "Director",
        self::GERENTE   => "Gerente"
    ];
}
