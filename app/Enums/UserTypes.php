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
    public const DIRECTOR_CIENTIFICO = "DC";
    public const DIRECTOR_ADMINISTRATIVO = "DA";

    protected static array $values = [
        self::TH        => "Talento Humano",
        self::JEFE      => "Jefe",
        self::GERENTE   => "Gerente",
        self::DIRECTOR  => "Director",
        self::DIRECTOR_CIENTIFICO => "Director Científico",
        self::DIRECTOR_ADMINISTRATIVO => "Director Administrativo"
    ];
}
