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
    public function getAll(int $reqId): ?array
    {
        try {
            $data = $this->db->select(static::TABLE."(O)", [
                "[>]usuario (U)" => ["quien" => "usuario_id"]
            ], [
                "author" => Medoo::raw("CONCAT_WS(' ', usuario_apellido1, usuario_nombre1)"),
                "O.id", "O.body", "O.created_at"
            ], [
                "req_id" => $reqId,
                "ORDER" => ["O.created_at" => "DESC"]
            ]);

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Encuentra una obsrvacion dependiendo de su ID. Este metodo se emplea
     * principalmente despues de crear una observacion.
     *
     * @param int $id
    */
    public function find(int $id): ?array
    {
        try {
            $data = $this->db->get(static::TABLE."(O)", [
                "[>]usuario (U)" => ["quien" => "usuario_id"]
            ], [
                "author" => Medoo::raw("CONCAT_WS(' ', usuario_apellido1, usuario_nombre1)"),
                "O.id", "O.body", "O.created_at"
            ], ["O.id" => $id]);

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
