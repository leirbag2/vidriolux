<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReportController;

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
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('usuarios',UserController::class);
    Route::resource('ventas',VentaController::class);
    Route::resource('historial',HistorialController::class);
    Route::resource('productos',ProductoController::class);
    Route::resource('categorias',CategoriaController::class);
    Route::get('/cart/add',[CartController::class,'add']);
    Route::get('/cart/store',[CartController::class,'store']);
    Route::get('/cart/destroy',[CartController::class,'destroy']);
    Route::get('/cart/deleteAll',[CartController::class,'deleteAll']);
    Route::resource('cart',CartController::class);
    Route::resource('reporte',ReportController::class);
});