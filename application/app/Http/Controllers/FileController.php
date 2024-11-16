<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Imports\InstrumentosImport;
use App\Models\File;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    function upload(UploadFileRequest $request)
    {
        try {
            $file = $request->file('upload');
            $name = $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $name, 's3');
            Excel::import(new InstrumentosImport, $file);
            File::create(['file_name' => $name, 'path' => $path]);
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
