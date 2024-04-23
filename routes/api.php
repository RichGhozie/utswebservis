<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/mahasiswa')->group(function () {
    Route::get('', [MahasiswaModelController::class, 'index']);
    Route::post('', [MahasiswaModelController::class, 'create']);
    Route::get('/{id}', [MahasiswaModelController::class, 'detail']);
    Route::put('/{id}', [MahasiswaModelController::class, 'update']);
    Route::patch('/{id}', [MahasiswaModelController::class, 'patch']);
    Route::delete('/{id}', [MahasiswaModelController::class, 'delete']);
});
