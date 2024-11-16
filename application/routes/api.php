<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\InstrumentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/files', [FileController::class, 'index']);
Route::post('/files/upload', [FileController::class, 'upload']);


Route::controller(InstrumentoController::class)->group(function () {
    Route::get('/instruments', 'index');
});
