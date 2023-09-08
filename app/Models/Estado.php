<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

class Estado
{
    public const TABLE = "cv_requisicion_estados";

    private Medoo $db;

    public function __construct(Medoo $db)
    {
        $this->db = $db;
    }

    /**
     * @return int Devuelve el ID del nuevo estado.
    */
    public function create(int $req_id, array $data): int
    {
        try {
            $this->db->insert(self::TABLE, [
                "by"     => $data["by"],
                "state"  => $data["state"],
                "req_id" => $req_id,
                "detail" => $data["detail"]
            ], "id");

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
