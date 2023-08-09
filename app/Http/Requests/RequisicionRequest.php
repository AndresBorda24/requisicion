<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Tipo;
use App\Enums\Motivo;
use App\Enums\NivelEducativo;

class RequisicionRequest extends BodyRequest
{
    public function validateInsert(array $data): array
    {
        try {
            $tipos = array_keys(Tipo::all());
            $motivos = array_keys(Motivo::all());
            $niveles = array_keys(NivelEducativo::all());

            return $this->validate($data, [
                "area" => "required",
                "cargo" => "required",
                "tipo" => "required|in:".implode(",", $tipos),
                "horas" => "required|integer",
                "motivo" => "required|in:".implode(",", $motivos),
                "sector" => "required",
                "horario" => "required",
                "jefe_id" => "required|integer",
                "area_id" => "required|integer",
                "cantidad" => "required|integer|min:1",
                "funciones" => "required",
                "area_anios" => "required|integer",
                "sector_anios" => "required|integer",
                "conocimientos" => "required",
                "nivel_educativo" => "required|in:".implode(",", $niveles),
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
