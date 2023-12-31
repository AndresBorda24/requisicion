<?php
declare(strict_types=1);

namespace App;

use App\Contracts\UserInterface;

class User implements UserInterface
{
    private int $id;
    private int $areaId;
    private int $cargoId;
    private ?int $jefeId;
    private string $grupo;
    private string $nombre;

    public function __construct(array $data)
    {
        try {
            $this->checkData($data);

            $this->id      = (int) $data["id"];
            $this->grupo   = $data["grupo"];
            $this->jefeId  = $data["jefe_id"] ? (int) $data["jefe_id"] : null;
            $this->areaId  = (int) $data["areaId"];
            $this->cargoId = (int) $data["cargo_id"];
            $this->nombre  = $data["nombre"];
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function getGrupo(): string
    {
        return $this->grupo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAreaId(): int
    {
        return $this->areaId;
    }

    public function getCargoId(): int
    {
        return $this->cargoId;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function isJefe(): bool
    {
        return ! ($this->jefeId === null);
    }

    public function getJefeId(): ?int
    {
        return $this->jefeId;
    }

    // Revisa los campos requeridos
    private function checkData(array $data): bool
    {
        foreach(["id", "areaId", "grupo", "cargo_id","jefe_id"]as $key) {
            if(! array_key_exists($key, $data)) {
                throw new \RuntimeException("Faltan datos usuario");
            }
        }

        return true;
    }

    public function isTh(): bool
    {
        // 29 es el id en la tabla area_servicio
        return ($this->getAreaId() === 29);
    }

    /**
     * Se encarga de retornar el "Tipo de usuario". Esto se usa en los
     * cambios de estado (especificamente en el campo `by`)
     *
     * @return Por defecto retornara JEFE
    */
    public function getUserType(): string
    {
        /*
            Estos valores son tomados de la tabla cargos de la base de datos de
            asotraum_calidad a los dias 25 del mes de septiembre del anio dos
            mil y veinte y tres.

            46 ---> Coordinado de Talento Humano
            476 ---> Director Administrativo
            49 ---> Director Médico Científico
            59 ---> Gerente
        */
        switch ($this->getCargoId()) {
            case 46: return \App\Enums\UserTypes::TH;
            case 47: return \App\Enums\UserTypes::DIRECTOR_ADMINISTRATIVO;
            case 49: return \App\Enums\UserTypes::DIRECTOR_CIENTIFICO;
            case 56: return \App\Enums\UserTypes::GERENTE;
            default: return \App\Enums\UserTypes::JEFE;
        }
    }
}
