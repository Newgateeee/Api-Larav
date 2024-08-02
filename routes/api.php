<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Registros de artículos
Route::get('/articulos', [ArticuloController::class, 'index']);
Route::post('/articulos', [ArticuloController::class, 'store']);
Route::get('/articulos/{id}', [ArticuloController::class, 'show']);
Route::put('/articulos/{id}', [ArticuloController::class, 'update']);
Route::delete('/articulos/{id}', [ArticuloController::class, 'destroy']);

// Registros de usuarios
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
Route::post('/login', [UsuarioController::class, 'login']);
