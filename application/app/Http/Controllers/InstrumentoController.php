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
        return response()->json(Instrumento::paginate()->toArray());
    }
}
