<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa un Enum para los motivos de requisicion.
*/
final class Motivo extends Enum
{
    public const CREACION = "CR";
    public const RETIRO   = "RT";
    public const LICVAC   = "LV";
    public const TRASLADO = "TD";

    protected static array $values = [
        self::CREACION => "Creación",
        self::RETIRO   => "Retiro",
        self::LICVAC   => "Lic. Vac.",
        self::TRASLADO => "Traslado",
    ];
}
