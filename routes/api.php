<?php

use App\Http\Controllers\DespesaController;
use App\Http\Controllers\AuthController;
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

//Estas serão as rotas publicas
Route::post('/cadastrar', [AuthController::class, 'cadastrar']);


//Estas serão as rotas protegidas por autenticacao (privadas)
Route::group(['middleware' => ['auth:sanctum']], function() {
    //"Route::resource" cria as rotas padrão do nosso crud
    Route::resource('/despesas', DespesaController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});
