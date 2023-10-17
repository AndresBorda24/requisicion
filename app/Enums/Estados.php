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
    public const RECHAZADO = "RZ";
    public const ANULADO   = "AN";
    public const CUMPLIDO  = "CR";
    public const DEVUELTO  = "DV";
    // public const PRENDIENTE_APRO = "PA";

    protected static array $values = [
        self::SOLICITUD => "En solicitud",
        self::REVISION  => "En revisi&oacute;n",
        self::APROBADO  => "Aprobado",
        self::RECHAZADO => "Rechazado",
        self::DEVUELTO  => "Devuelto",
        self::ANULADO   => "Anulado",
        self::CUMPLIDO  => "Cumplido",
        // self::PRENDIENTE_APRO => "Pendiente por aprobaci&oacute;n",
    ];

    /**
     * Obtiene el Estado con el tipo de usuario que lo realizo.
    */
    public static function publicBy($state, $by): string
    {
        return sprintf("%s por %s",...[
            self::value($state),
            UserTypes::value($by)
        ]);
    }
}
