<?php

namespace App\Http\Controllers;

use App\Helpers\SearchHelper;
use App\Http\Requests\UploadFileRequest;
use App\Imports\InstrumentosImport;
use App\Models\File;
use App\Services\Files\FileServiceInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileController extends Controller
{
    public function __construct(private FileServiceInterface $fileService) {}
    /**
     *
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $queryArray = SearchHelper::toArray($request->query('q'));
        $files = $this->fileService->search($queryArray);
        return response()->json($files);
    }

    function upload(UploadFileRequest $request)
    {
        try {
            $file = $request->file('upload');
            $name = $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $name, 's3');
            $fileModel = $this->fileService->saveFileName($name, $path);
            Excel::import(new InstrumentosImport($fileModel->id), $file);
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
