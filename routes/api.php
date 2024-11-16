<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\MangaController;

// Rutas de autenticación
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Rutas públicas
Route::get('/public/mangas', [MangaController::class, 'index']);

// Acceso a rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::apiResource('categorias', CategoriaController::class);

    Route::apiResource('subcategorias', SubcategoriaController::class);

    Route::apiResource('mangas', MangaController::class);
});
