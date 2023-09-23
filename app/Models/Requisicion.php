<?php
declare(strict_types=1);

namespace App\Models;

use App\Enums\Estados;
use App\Enums\NivelEducativo;
use App\Enums\Tipo;
use App\Enums\UserTypes;
use Medoo\Medoo;

class Requisicion
{
    public const TABLE = "cv_requisiciones";

    public Medoo $db;

    public function __construct(Medoo $db)
    {
        $this->db = $db;
    }

    /**
     * Realiza la insercion de una requisicion en la base de datos.
     *
     * @param int $updateId Sirve para identificar si se hace un insert o un
     * update, si se pasa y es un entero mayor a 0 se intenta realizar la
     * actualizacion de otro modo se hace el insert
     *
     * @return int INSERT: insert id | UPDATE: rowCount.
    */
    public function save(array $data, int $updateId = 0): int
    {
        $error = null;
        $newId = null;
        $this->db->action(function($db) use($data, $updateId, &$newId, &$error) {
            try {
                if ($updateId > 0) {
                    $reqId = $updateId;
                    $this->update($updateId, $data);
                } else {
                    $reqId = $this->new($data);
                }

                (new Estado($db))->create($reqId, [
                    "by"     => UserTypes::JEFE,
                    "state"  => Estados::SOLICITUD,
                    "detail" => @$data["observacion"]
                ]);

                $newId = $reqId;
            } catch(\Exception $e) {
                $error = $e;
                return false;
            }
        });

        if ($error !== null) throw $error;

        return (int) $newId;
    }

    /**
     * Realiza la actualizadcion de una requisicion en la base de datos.
     *
     * @return int id de la requisicion.
    */
    public function update(int $id, array $data): int
    {
        try {
            $_ = $this->db->update(static::TABLE, [
                "tipo" => $data["tipo"],
                "horas" => $data["horas"],
                "cargo" => mb_strtoupper($data["cargo"]),
                "state" => Estados::SOLICITUD,
                "motivo" => $data["motivo"],
                "motivo_desc" => $data["motivo_desc"],
                "horario" => $data["horario"],
                "cantidad" => $data["cantidad"],
                "funciones" => $data["funciones"],
                "conocimientos" => $data["conocimientos"]
            ], [ "id" => $id ]);

            return $_->rowCount();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Crea una nueva requisicion.
     *
     * @return int Id de la nueva requisicion
    */
    public function new(array $data): int
    {
        try {
            $this->db->insert(static::TABLE, [
                "tipo" => $data["tipo"],
                "horas" => $data["horas"],
                "cargo" => mb_strtoupper($data["cargo"]),
                "state" => Estados::SOLICITUD,
                "motivo" => $data["motivo"],
                "motivo_desc" => $data["motivo_desc"],
                "horario" => $data["horario"],
                "jefe_id" => $data["jefe_id"],
                "area_id" => $data["area_id"],
                "cantidad" => $data["cantidad"],
                "funciones" => $data["funciones"],
                "conocimientos" => $data["conocimientos"]
            ], 'id');

            return (int) $this->db->id();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function updateTh(int $id, array $data): int
    {
        $error = null;
        $this->db->action(function($db) use($id, $data, &$error) {
            try {
                $this->setChangesTh($id, $data);
                (new Estado($db))->create($id, [
                    "by"     => UserTypes::TH,
                    "state"  => Estados::APROBADO,
                    "detail" => @$data["observacion"]
                ]);
            } catch(\Exception $e) {
                $error = $e;
                return false;
            }
        });

        if ($error !== null) throw $error;

        return 1;
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
                "[>]cv_req_estado_view (E)" => ["id" => "req_id"],
                "[>]vista_jefes (J)" => "jefe_id",
            ], [
                "A.area_servicio_nombre (area_nombre)", "area_id",
                "J.usuario_nombrec (jefe_nombre)", "E.state", "E.by",
                "R.id", "R.area", "R.tipo", "R.horas", "R.cargo", "R.motivo_desc",
                "R.motivo", "R.sector", "R.horario", "R.cantidad",
                "R.jefe_id", "R.funciones", "R.area_anios", "R.sector_anios",
                "R.conocimientos", "R.nivel_educativo", "R.created_at"
            ], ["R.id" => $id ]);

            if (!$_) throw new \Exception("Requisicion no encontrada.");

            $_["_tipo"]  = Tipo::value($_["tipo"]);
            $_["_motivo"] = \App\Enums\Motivo::value($_["motivo"]);
            $_["_nivel_educativo"] = $_["nivel_educativo"]
                ? NivelEducativo::value($_["nivel_educativo"])
                : null;
            $_["_state"] = sprintf("%s por %s",...[
                Estados::value($_["state"]),
                UserTypes::value($_["by"])
            ]);

            return $_;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene informacion basica sobre la requisicion. Principalmnete se usa
     * para adjuntar nuevos items a la grilla luego de creados.
    */
    public function findBasic(int $id): ?array
    {
        try {
            $_ = $this->db->get(static::TABLE."(R)", [
                "[>]area_servicio (A)" => ["area_id" => "area_servicio_id"],
                "[>]cv_req_estado_view (E)" => ["id" => "req_id"]
            ], [
                "A.area_servicio_nombre (area_nombre)",
                "R.id", "R.cargo", "E.state", "E.by", "R.created_at", "R.area_id"
            ], [ "R.id" => $id ]);

            if (!$_) throw new \Exception("Requisicion no encontrada.");

            $_["_state"] = sprintf("%s por %s",...[
                Estados::value($_["state"]),
                UserTypes::value($_["by"])
            ]);
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
            $where = [
                "E.state[~]" => $state,
                "ORDER" => ["R.created_at" => "ASC"]
            ];
            if ($jefeId) $where["jefe_id"] = $jefeId;

            $data = [];
            $this->db->select(static::TABLE." (R)", [
                "[>]area_servicio (A)" => ["area_id" => "area_servicio_id"],
                "[>]cv_req_estado_view (E)" => ["id" => "req_id"]
            ], [
                "A.area_servicio_nombre (area_nombre)",
                "R.id", "R.cargo", "E.state", "E.by", "R.created_at", "R.area_id"
            ], $where, function($item) use(&$data) {
                $item["_state"] = sprintf("%s por %s",...[
                    Estados::value($item["state"]),
                    UserTypes::value($item["by"])
                ]);

                array_push($data, $item);
            });

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualizacion realizada por TH.
    */
    public function setChangesTh(int $id, array $data): int
    {
        try {
            $_ = $this->db->update(static::TABLE, [
                "area" => $data["area"],
                "state" => Estados::REVISION,
                "sector" => $data["sector"],
                "area_anios" => $data["area_anios"],
                "sector_anios" => $data["sector_anios"],
                "nivel_educativo" => $data["nivel_educativo"]
            ], [ "id" => $id ]);

            return $_->rowCount();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene las obsercaciones **de los estados** de una requisicion.
    */
    public function getObservaciones(int $id): array
    {
        try {
            $data = [];
            $this->db->select(static::TABLE."(R)", [
                "[<]".Estado::TABLE." (E)" => [ "id" => "req_id" ]
            ], [
                "E.state", "E.by",
                "E.id", "E.detail (body)", "E.at"
            ], [
                "E.req_id" => $id,
                "ORDER" => [ "E.at" => "DESC"]
            ], function($item) use(&$data) {
                $item["author"] = sprintf("%s por %s",...[
                    Estados::value($item["state"]),
                    UserTypes::value($item["by"])
                ]);

                array_push($data, $item);
            });

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Obtiene las observaciones de una requisicion tanto de los estados como
     * de la tabla cv_req_observaciones
    */
    public function getAllObs(int $id): array
    {
        try {
            $query = $this->db->query("(
                    SELECT
                         `E`.`id`, `E`.`state`, `E`.`by`, `E`.`detail` AS `body`,  `E`.`at`
                    FROM cv_requisiciones AS `R`
                    LEFT JOIN cv_requisicion_estados AS `E`
                        ON `R`.`id` = `E`.`req_id`
                    WHERE <E.req_id> = :req_id
                ) UNION (
                    SELECT
                        CONCAT('O-',`O`.`id`) AS `id`,
                        NULL AS `state`,
                        CONCAT_WS(' ', usuario_apellido1, usuario_nombre1) AS `by`,
                        `O`.`body`,
                        `O`.`created_at` AS `at`
                    FROM `cv_req_observaciones` AS `O`
                    LEFT JOIN `usuario` AS `U`
                        ON `O`.`quien` = `U`.`usuario_id`
                    WHERE <req_id> = :req_id
                )
                ORDER BY `at` DESC
            ", [ ":req_id" => $id ]);

            $data = [];
            while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                if ($row["state"] !== null) {
                    $row["author"] = sprintf("%s por %s",...[
                        Estados::value($row["state"]),
                        UserTypes::value($row["by"])
                    ]);
                } else {
                    $row["author"] = $row["by"];
                }

                unset($row["by"], $row["state"]);
                array_push($data, $row);
            }

            return $data;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
