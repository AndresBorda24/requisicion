<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa un Enum para los niveles educativos.
*/
final class NivelEducativo extends Enum
{
    public const BACHILLER     = "BC";
    public const TECNICO       = "TC";
    public const TECNOLOGO     = "TG";
    public const PROFESIONAL   = "PR";
    public const ESPECIALIZACION = "ES";

    protected static array $values = [
        self::BACHILLER     => "Bachiller",
        self::TECNICO       => "T&eacute;cnico",
        self::TECNOLOGO     => "Tecnologo",
        self::PROFESIONAL   => "Profesional",
        self::ESPECIALIZACION => "Especializaci&oacute;n"
    ];
}
