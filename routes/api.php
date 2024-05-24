<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;

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

Route::middleware('api')->get('/user', function (Request $request) {
    return response()->json(["response" => 'att']);
});

Route::middleware('api')->get('/produtos', [ProdutosController::class, 'index']);
Route::middleware('api')->get('/produto/{id}', [ProdutosController::class, 'getProduto']);
Route::middleware('api')->post('/create/produto', [ProdutosController::class, 'store']);
Route::middleware('api')->put('/update/produto/{id}', [ProdutosController::class, 'update']);
Route::middleware('api')->put('/delete/produto/{id}', [ProdutosController::class, 'delete']);