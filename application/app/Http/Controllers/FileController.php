<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Http\Response;

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
        return response()->json(["Uploaded!", Response::HTTP_CREATED]);
    }
}
