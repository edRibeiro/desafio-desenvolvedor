<?php

namespace App\Services\Instrumentos;

use App\Models\Instrumento;
use Illuminate\Database\Eloquent\Builder;

class InstrumentoService implements InstrumentoServiceInterface
{
    public function search($queryArray)
    {
        $search = Instrumento::query();
        $search->where('deleted_at', '=', null);
        if (count($queryArray) > 0) {
            foreach ($queryArray as $field => $value) {
                if ($field === "file_name" && !empty($value)) {
                    $search->whereHas('file', function (Builder $query) use ($value) {
                        $query->where('file_name', 'like', '%' . $value . '%');
                    });
                } elseif (!empty($value)) {
                    // Aplica o filtro diretamente à tabela Instrumento para outros campos
                    $search->where($field, '=', $value);
                }
            }

            return $search->get();
        }

        return $search->paginate();
    }
}
