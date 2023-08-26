<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

class Observacion
{
    public const TABLE = "cv_req_observaciones";

    private Medoo $db;

    public function __construct(Medoo $db)
    {
        $this->db = $db;
    }

    /**
     * Realiza la insercion de una observacion en la base de datos.
     *
     * @return int id de la nueva requisicion.
    */
    public function create(array $data): int
    {
        try {
            $this->db->insert(static::TABLE, [
                "req_id" => $data["req_id"],
                "body"   => $data["body"],
                "quien"  => $data["quien"]
            ], 'id');

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene todas las observaciones de cierta requisicion.
     *
     * @param int $reqId El id de la requisicion a buscar.
    */
    public function getAll(int $reqId): array
    {
        try {
            $data = [];
            $this->db->select(static::TABLE."(R)", [
                "[>]area_servicio (A)" => ["area_id" => "area_servicio_id"]
            ], [
                "A.area_servicio_nombre (area_nombre)",
                "R.id", "R.cargo", "R.state", "R.created_at"
            ], [ "req_id" => $reqId ], function($item) use(&$data) {
                array_push($data, $item);
            });

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
