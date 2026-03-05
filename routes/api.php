<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TipoVacunaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tipos-vacunas', [TipoVacunaController::class, 'index']);
Route::post('tipos-vacunas', [TipoVacunaController::class, 'store']);
Route::put('tipos-vacunas/{id}', [TipoVacunaController::class, 'update']);
Route::delete('tipos-vacunas/{id}', [TipoVacunaController::class, 'destroy']);
