<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Representa un Enum para los tipos de requisicion.
*/
class Enum
{
    /**
     * Representa los valores 'humanos' de las constantes.
    */
    protected static array $values = [];

    /**
     * Obtiene el valor 'humano' del tipo.
     *
     * @param string $tipo Debe ser una de las constantes de la clase.
     * @throws \Exception Si no se encuentra el $tipo arroja una exception.
    */
    public static function value(string $tipo): string
    {
        if(! array_key_exists($tipo, static::$values)) {
            throw new \Exception("$tipo not found...");
        }

        return static::$values[ $tipo ];
    }

    /**
     * @return array Array de los valores. Para las llaves es la constante y el
     * valor es el valor 'humano'.
    */
    public static function all(): array
    {
        return static::$values;
    }
}
