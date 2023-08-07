<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

class Requisicion
{
    public const TABLE = "cv_requisiciones";

    private Medoo $db;

    public function __construct(Medoo $db)
    {
        $this->db = $db;
    }

    /**
     * Realiza la insercion de una requisicion en la base de datos.
     *
     * @return int id de la nueva requisicion.
    */
    public function create(array $data): int
    {
        try {
            $_ = $this->db->insert(static::TABLE, [
                "area" => $data["area"],
                "cargo" => $data["cargo"],
                "tipo" => $data["tipo"],
                "horas" => $data["horas"],,
                "motivo" => $data["motivo"],
                "sector" => $data["sector"],
                "horario" => $data["horario"],
                "jefe_id" => $data["jefe_id"],
                "funciones" => $data["funciones"],
                "area_anios" => $data["area_anios"],
                "sector_anios" => $data["sector_anios"],
                "conocimientos" => $data["conocimientos"],
                "nivel_educativo" => $data["nivel_educativo"],
            ], 'id');

            return (int) $_;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Busca y retorna la informacion de una requisicion.
     *
     * @throws Exception Si no encuentra ninguna requisicion que coincida con
     * el id.
    */
    public function find(int $id): array
    {
        try {
            $_ = $this->db->get(static::TABLE, "*", ["id" => $id ]);
            if (!$_) throw new \Exception("Requisicion no encontrada.");

            return $_;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
