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
                "tipo" => $data["tipo"],
                "horas" => $data["horas"],
                "cargo" => $data["cargo"],
                "state" => "PENDIENTE",
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

            return (int) $this->db->id();
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
            $_ = $this->db->get(static::TABLE." (R)", [
                "[<]area_servicio (A)" => ["area_id" => "area_servicio_id"]
            ], [
                "A.area_servicio_nombre (area_nombre)",
                "R.area", "R.tipo", "R.horas", "R.cargo",
                "R.state", "R.motivo", "R.sector", "R.horario",
                "R.jefe_id", "R.funciones", "R.area_anios", "R.sector_anios",
                "R.conocimientos", "R.nivel_educativo"
            ], ["id" => $id ]);

            if (!$_) throw new \Exception("Requisicion no encontrada.");

            return $_;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene todas las requisiciones dependiendo de `$state`.
     *
     * @param string $state Si es vacio toma TODAS las requisiciones.
     * @return array
    */
    public function getAll(string $state = "")
    {
        try {
            $_ = $this->db->select(static::TABLE."(R)", [
                "[<]area_servicio (A)" => ["area_id" => "area_servicio_id"]
            ], [
                "A.area_servicio_nombre (area_nombre)",
                "R.id", "R.area", "R.tipo", "R.horas", "R.cargo",
                "R.state", "R.motivo", "R.sector", "R.horario",
                "R.jefe_id", "R.funciones", "R.area_anios", "R.sector_anios",
                "R.conocimientos", "R.nivel_educativo", "R.created_at"
            ], ["state[~]" => $state]);

            if ($_ === null) throw new \Exception("No requisiciones encontradas");

            return $_;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
