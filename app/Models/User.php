<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;
use App\User as Usuario;
use App\Contracts\UserInterface;
use App\Enums\UserTypes;

class User
{
    public const TABLE = "usuario";
    public const VISTA_JEFES = "vista_jefes";

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

    /**
     * Recupera los telefonos y correos electronicos de los diferentes tipos de
     * usuario: gerente, directores y th
     *
     * @param int $jefeId El id del jefe
     * @return array Un array siendo sus llaves el tipo de usuario y su valor
     *               un array con correo y telefono.
     */
    public function getContactData(int $jefeId): array
    {
        try {
            $data = [];
            $formatter = function($item) use(&$data) {
                $data[UserTypes::getFromCargo($item["cargo_id"])] = [
                    "tel" => $item["tel"],
                    "email" => $item["email"]
                ];
            };

            $this->db->select(self::VISTA_JEFES, [
                "cargo_id [Int]", "usuario_celular (tel)", "usuario_correo (email)"
            ], ["jefe_id" => $jefeId], $formatter);

            $this->db->select(self::VISTA_JEFES, [
                "cargo_id [Int]", "usuario_celular (tel)", "usuario_correo (email)"
            ], [
                "jefe_estado" => "A",
                "cargo_id" => [
                    UserTypes::getCargoId(UserTypes::TH),
                    UserTypes::getCargoId(UserTypes::GERENTE),
                    UserTypes::getCargoId(UserTypes::DIRECTOR_CIENTIFICO),
                    UserTypes::getCargoId(UserTypes::DIRECTOR_ADMINISTRATIVO),
                ]
            ], $formatter);

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
