<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WellController;
use App\Http\Controllers\HandBookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

Route::get('/wells', [WellController::class, 'index']);                // Получить все скважины
Route::get('/wells/{id}', [WellController::class, 'show']);             // Получить одну скважину
Route::put('/wells/{id}', [WellController::class, 'update']);           // Обновить данные скважины
Route::patch('/wells/{id}/toggle-save', [WellController::class, 'toggleSave']);  // Изменить статус сохранения

Route::get('/handbook', [HandBookController::class, 'index']);    // Получить все данные

