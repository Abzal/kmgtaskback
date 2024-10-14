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
    Route::get('/well-numbers', [WellController::class, 'getWellNumbers'])->middleware('permission:read wells');
    Route::put('/wells', [WellController::class, 'updateMultiple'])->middleware('permission:save wells');
    Route::patch('/wells/save', [WellController::class, 'saveMultiple'])->middleware('permission:save wells');
    Route::patch('/wells/unsave', [WellController::class, 'unsaveMultiple'])->middleware('permission:delete wells');


    // Эндпоинты для справочника
    Route::get('/handbook', [HandBookController::class, 'index'])->middleware('permission:read wells');
});
