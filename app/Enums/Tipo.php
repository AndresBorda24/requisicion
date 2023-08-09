<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa un Enum para los tipos de requisicion.
*/
final class Tipo extends Enum
{
    public const TEMPORAL    = "TM";
    public const DIRECTO     = "DT";
    public const MANDATO     = "CM";
    public const APRENDIZ    = "CA";
    public const OUTSOURCING = "OS";

    protected static array $values = [
        self::TEMPORAL    => "Temporal",
        self::DIRECTO     => "Directo con Cl&iacute;nica",
        self::MANDATO     => "Contrato de Mandato",
        self::APRENDIZ    => "Contrato de Aprendizaje",
        self::OUTSOURCING => "Outsourcing"
    ];
}
