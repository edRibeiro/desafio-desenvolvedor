<?php

use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('files')->group(function () {
    Route::controller(FileController::class)->group(function () {
        Route::post('/upload', 'upload');
    });
});
