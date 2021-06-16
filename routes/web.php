<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentasController;
use App\Http\Controllers\VentaProductosController;

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
    return view('auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('usuarios',UserController::class);
    Route::resource('ventas',VentaController::class);
    Route::resource('detalle',DetalleVentasController::class);
    Route::resource('historial',HistorialController::class);
    Route::resource('ventaproductos',VentaProductosController::class);
});