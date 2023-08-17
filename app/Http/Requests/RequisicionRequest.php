<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Tipo;
use App\Enums\Motivo;

class RequisicionRequest extends BodyRequest
{
    public function validateInsert(array $data): array
    {
        try {
            $tipos = array_keys(Tipo::all());
            $motivos = array_keys(Motivo::all());

            return $this->validate($data, [
                "cargo"     => "required",
                "cantidad"  => "required|integer|min:1",
                "motivo"    => "required|in:".implode(",", $motivos),
                "tipo"      => "required|in:".implode(",", $tipos),
                "horario"   => "required",
                "horas"     => "required|integer",
                "funciones" => "nullable",
                "observacion" => "nullable",
                "conocimientos" => "required"
            ]);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
