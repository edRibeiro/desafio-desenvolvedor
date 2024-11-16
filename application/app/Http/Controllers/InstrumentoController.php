<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Imports\InstrumentosImport;
use App\Models\File;
use App\Models\Instrumento;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InstrumentoController extends Controller
{
    function index()
    {
        return response()->json(Instrumento::all()->toArray());
    }

    function upload(UploadFileRequest $request)
    {
        try {
            $file = $request->file('upload');
            $name = $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $name, 's3');
            File::create(['file_name' => $name, 'path' => $path]);
            Excel::queueImport(new InstrumentosImport, $name, 's3');
            return response()->json([
                'message' => 'Arquivo enviado com sucesso!',
                'original_name' => $name,
                'path' => $path,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Erro ao processar o upload.',
                'details' => $th->getMessage(),
            ], 500);
        }
    }
}
