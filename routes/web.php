<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/set_language/{lang}', [App\Http\Controllers\Controller::class, 'set_language'])->name('set_language');

    Route::post('/Create/Empresa', [App\Http\Controllers\EmpresaController::class, 'create']);
    Route::post('/Update/Empresa/{id}', [App\Http\Controllers\EmpresaController::class, 'update']);
    Route::delete('/Delete/Empresa/{id}', [App\Http\Controllers\EmpresaController::class, 'delete']);

    Route::post('/Create/Empleado', [App\Http\Controllers\EmpleadoController::class, 'create']);
    Route::post('/Update/Empleado/{id}', [App\Http\Controllers\EmpleadoController::class, 'update']);
    Route::delete('/Delete/Empleado/{id}', [App\Http\Controllers\EmpleadoController::class, 'delete']);


});
