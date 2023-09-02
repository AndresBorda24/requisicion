<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

class Db
{
    public Medoo $db;

    public function __construct(Medoo $db)
    {
        $this->db = $db;
    }

    public function getAreas(): ?array
   {
        try {
            return $this->db->select("area_servicio", [
                "area_servicio_id (id)",
                "area_servicio_nombre (nombre)"
            ], [
                "ORDER" => ["area_servicio_nombre" => "ASC"]
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
