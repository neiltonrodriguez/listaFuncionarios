<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios');
Route::get('/funcionarios/get', [FuncionarioController::class, 'getFunc'])->name('funcionariosGet');
Route::post('/funcionarios/salvar', [FuncionarioController::class, 'salvarFunc'])->name('funcionariosSalvar');
Route::get('/funcionarios/delete/{id}', [FuncionarioController::class, 'deleteFunc'])->name('funcionariosDelete');
