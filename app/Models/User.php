<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;
use App\User as Usuario;
use App\Contracts\UserInterface;

class User
{
    public const TABLE = "usuario";

    private Medoo $db;

    public function __construct(Medoo $db)
    {
        $this->db = $db;
    }

    /**
     * Trae la informacion de un usuario dependiendo de su ID
     *
    */
    public function find(int $id): ?UserInterface
    {
        try {
            $u = $this->db->get(static::TABLE." (U)", [
                "[>]jefes (J)" => ["usuario_id" => "id_usuario"]
            ], [
                "U.cargo_id",
                "U.usuario_id (id)",
                "U.usuario_grupo (grupo)",
                "J.jefe_area (areaId)",
                "J.jefe_id",
                "nombre" => Medoo::raw("CONCAT_WS(
                        ' ',
                        `usuario_apellido1`,
                        `usuario_apellido2`,
                        `usuario_nombre1`,
                        `usuario_nombre2`
                )")
            ], [
                "U.usuario_id" => $id,
                "J.jefe_estado" => "A"
            ]);

            if (!$u) return null;

            return new Usuario($u);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
