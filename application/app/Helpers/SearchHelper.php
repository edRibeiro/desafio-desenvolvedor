<?php

namespace App\Helpers;

use Illuminate\Support\Arr;
use InvalidArgumentException;

class SearchHelper
{
    public static function toArray($query): array
    {
        if (!is_string($query) || empty(trim($query))) {
            return [];
        }
        $criteria = explode(',', $query);
        return array_merge(...Arr::map($criteria, function (string $item) {
            if (!str_contains($item, ':')) {
                throw new InvalidArgumentException("Formato inválido para o critério: {$item}");
            }

            // Divide o item em 'campo' e 'valor'
            [$field, $value] = explode(':', $item);

            if (empty($field) || empty($value)) {
                throw new InvalidArgumentException("Formato inválido para o critério: {$item}");
            }

            // Retorna como um par chave-valor diretamente
            return [$field => $value];
        }));
    }
}
