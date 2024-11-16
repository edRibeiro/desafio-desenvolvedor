<?php

namespace App\Http\Controllers;

use App\Helpers\SearchHelper;
use App\Services\Instrumentos\InstrumentoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InstrumentoController extends Controller
{
    public function __construct(private InstrumentoServiceInterface $service) {}

    function index(Request $request)
    {
        $cacheKey = 'instrumentos';
        $query = $request->query('q');
        if (!empty($query)) {
            $cacheKey .= ':' . $query;
        }

        $instrumentos = Cache::remember($cacheKey, 300, function () use ($query) {
            $queryArray = SearchHelper::toArray($query);
            return  $this->service->search($queryArray);
        });
        return response()->json($instrumentos->toArray());
    }
}
