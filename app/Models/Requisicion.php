<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\Estados;
use App\Enums\NivelEducativo;
use App\Enums\Tipo;
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
            $this->db->insert(static::TABLE, [
                "tipo" => $data["tipo"],
                "horas" => $data["horas"],
                "cargo" => $data["cargo"],
                "state" => Estados::SOLICITUD,
                "motivo" => $data["motivo"],
                "horario" => $data["horario"],
                "jefe_id" => $data["jefe_id"],
                "area_id" => $data["area_id"],
                "cantidad" => $data["cantidad"],
                "funciones" => $data["funciones"],
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
                "[>]area_servicio (A)" => ["area_id" => "area_servicio_id"],
                "[>]vista_jefes (J)" => "jefe_id"
            ], [
                "A.area_servicio_nombre (area_nombre)",
                "J.usuario_nombrec (jefe_nombre)",
                "R.id", "R.area", "R.tipo", "R.horas", "R.cargo",
                "R.state", "R.motivo", "R.sector", "R.horario", "R.cantidad",
                "R.jefe_id", "R.funciones", "R.area_anios", "R.sector_anios",
                "R.conocimientos", "R.nivel_educativo", "R.created_at"
            ], ["id" => $id ]);

            if (!$_) throw new \Exception("Requisicion no encontrada.");

            $_["_tipo"] = Tipo::value($_["tipo"]);
            $_["_motivo"] = \App\Enums\Motivo::value($_["motivo"]);
            $_["_nivel_educativo"] = $_["nivel_educativo"]
                ? NivelEducativo::value($_["nivel_educativo"])
                : null;

            return $_;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene todas las requisiciones dependiendo de `$state`.
     *
     * @param string $state Si es vacio toma TODAS las requisiciones.
     * @param ?int $jefeId Si no es nulo se buscan solo las de ese jege
     * en especifico
     * @return array
    */
    public function getAll(string $state = "", ?int $jefeId = null)
    {
        try {
            $where = ["state[~]" => $state];
            if ($jefeId) $where["jefe_id"] = $jefeId;

            $data = [];
            $this->db->select(static::TABLE."(R)", [
                "[>]area_servicio (A)" => ["area_id" => "area_servicio_id"]
            ], [
                "A.area_servicio_nombre (area_nombre)",
                "R.id", "R.cargo", "R.state", "R.created_at"
            ], $where, function($item) use(&$data) {
                $item["state"] = Estados::value($item["state"]);
                array_push($data, $item);
            });

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
