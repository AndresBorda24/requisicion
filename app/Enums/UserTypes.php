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

    public static function getCargoId(string $tipo): ?int
    {
        switch ($tipo) {
            case  \App\Enums\UserTypes::TH: return 46;
            case  \App\Enums\UserTypes::GERENTE: return 56;
            case  \App\Enums\UserTypes::DIRECTOR_CIENTIFICO: return 49;
            case  \App\Enums\UserTypes::DIRECTOR_ADMINISTRATIVO: return 47;
            default: null;
        }
    }

    public static function getFromCargo(int $cargoId): ?string
    {
        switch ($cargoId) {
            case 46: return \App\Enums\UserTypes::TH;
            case 56: return \App\Enums\UserTypes::GERENTE;
            case 49: return \App\Enums\UserTypes::DIRECTOR_CIENTIFICO;
            case 47: return \App\Enums\UserTypes::DIRECTOR_ADMINISTRATIVO;
            default: return \App\Enums\UserTypes::JEFE;
        }
    }
}
