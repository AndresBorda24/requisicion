<?php
declare(strict_types=1);

namespace App\Http\Requests;

class RequisicionRequest extends BodyRequest
{
    public function validateInsert(array $data): array
    {
        try {
            return $this->validate($data, [
                "area" => "required",
                "cargo" => "required",
                "tipo" => "required",
                "horas" => "required|integer",
                "motivo" => "required",
                "sector" => "required",
                "horario" => "required",
                "jefe_id" => "required",
                "funciones" => "required",
                "area_anios" => "required|integer",
                "sector_anios" => "required|integer",
                "conocimientos" => "required",
                "nivel_educativo" => "required",
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
