<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Estados;
use App\Enums\Tipo;
use App\Enums\Motivo;
use App\Enums\NivelEducativo;
use App\Enums\UserTypes;

class RequisicionRequest extends BodyRequest
{
    public function validateInsert(array $data): array
    {
        try {
            $tipos = array_keys(Tipo::all());
            $motivos = array_keys(Motivo::all());

            return $this->validate($data, [
                "cargo"       => "required",
                "cantidad"    => "required|integer|min:1",
                "motivo"      => "required|in:".implode(",", $motivos),
                "motivo_desc" => "required",
                "tipo"        => "required|in:".implode(",", $tipos),
                "horario"     => "required",
                "horas"       => "required|integer",
                "director"    => "nullable|default:null",
                "funciones"   => "nullable",
                "observacion" => "nullable",
                "conocimientos" => "required"
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function validataUpdateTh(array $data): array
    {
        try {
            $nivel = array_keys(NivelEducativo::all());

            return $this->validate($data, [
                "area"          => "required",
                "sector"        => "required",
                "area_anios"    => "required|integer",
                "observacion"   => "nullable",
                "sector_anios"  => "required|integer",
                "nivel_educativo" => "required|in:".implode(",", $nivel)
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function validataUpdateState(array $data): array
    {
        try {
            $estados = array_keys(Estados::all());
            $userTypes = array_keys(UserTypes::all());

            return $this->validate($data, [
                "by"     => "required|in:".implode(",", $userTypes),
                "detail" => "required|max:280",
                "state"  => "required|in:".implode(",", $estados)
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
