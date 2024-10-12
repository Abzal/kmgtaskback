<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WellController;
use App\Http\Controllers\HandBookController;

// Аутентификация
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

// Защищенные маршруты (требуется Bearer Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Эндпоинты для скважин
    Route::get('/wells', [WellController::class, 'index'])->middleware('permission:read wells');
    Route::get('/wells/{id}', [WellController::class, 'show'])->middleware('permission:read wells');
    Route::put('/wells/{id}', [WellController::class, 'update'])->middleware('permission:save wells');
    Route::patch('/wells/{id}/toggle-save', [WellController::class, 'toggleSave'])->middleware('permission:save wells');
    Route::delete('/wells/{id}', [WellController::class, 'destroy'])->middleware('permission:delete wells');

    // Эндпоинты для справочника
    Route::get('/handbook', [HandBookController::class, 'index'])->middleware('permission:read wells');
});
