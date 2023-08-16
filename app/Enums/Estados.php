<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa un Enum para los motivos de requisicion.
*/
final class Estados extends Enum
{
    public const SOLICITUD  = "SO";
    public const REVISION   = "RV";
    public const APROVADO   = "AP";
    public const ANULADO    = "AN";
    public const PRENDIENTE_APRO = "PA";

    protected static array $values = [
        self::SOLICITUD => "En solicitud",
        self::REVISION  => "En revisi&oacute;n",
        self::APROVADO  => "Aprovado",
        self::ANULADO   => "Anulado",
        self::PRENDIENTE_APRO => "Pendiente por aprovaci&oacute;n",
    ];
}
