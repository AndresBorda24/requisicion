<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa un Enum para los motivos de requisicion.
*/
final class Estados extends Enum
{
    public const SOLICITUD = "SO";
    public const REVISION  = "RV";
    public const APROBADO  = "AP";
    public const ANULADO   = "AN";
    public const CUMPLIDO  = "CR";
    public const PRENDIENTE_APRO = "PA";
    public const DEVUELTO  = "DV";

    protected static array $values = [
        self::SOLICITUD => "En solicitud",
        self::REVISION  => "En revisi&oacute;n",
        self::APROBADO  => "Aprobado",
        self::DEVUELTO  => "Devuelto",
        self::ANULADO   => "Anulado",
        self::CUMPLIDO  => "Cumplido",
        self::PRENDIENTE_APRO => "Pendiente por aprobaci&oacute;n",
    ];
}
