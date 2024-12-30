<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\TipoArticulosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('ventas', VentasController::class);
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::get('/ventas/create', [VentasController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
Route::get('ventas/{id}/edit', [VentasController::class, 'edit'])->name('ventas.edit');
Route::delete('ventas/{id}', [VentasController::class, 'destroy'])->name('ventas.destroy');
Route::put('/ventas/{venta}', [VentasController::class, 'update'])->name('ventas.update');




Route::get('/articulos', [ArticulosController::class, 'index'])->name('articulos.index');
Route::get('/articulos/create', [ArticulosController::class, 'create'])->name('articulos.create');
Route::post('/articulos', [ArticulosController::class, 'store'])->name('articulos.store');
Route::get('/articulos/{articulos}/edit', [ArticulosController::class, 'edit'])->name('articulos.edit');
Route::delete('/articulos/{articulos}', [ArticulosController::class, 'destroy'])->name('articulos.destroy');
Route::put('/articulos/{articulos}', [ArticulosController::class, 'update'])->name('articulos.update');


Route::get('/tipoarticulos', [TipoArticulosController::class, 'index'])->name('tipoarticulos.index');
Route::get('/tipoarticulos/create', [TipoArticulosController::class, 'create'])->name('tipoarticulos.create');
Route::post('/tipoarticulos', [TipoArticulosController::class, 'store'])->name('tipoarticulos.store');
Route::get('/tipoarticulos/{tipoArticulos}/edit', [TipoArticulosController::class, 'edit'])->name('tipoarticulos.edit');
Route::put('/tipoarticulos/{tipoArticulos}', [TipoArticulosController::class, 'update'])->name('tipoarticulos.update');
Route::delete('/tipoarticulos/{tipoArticulos}', [TipoArticulosController::class, 'destroy'])->name('tipoarticulos.destroy');


Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');

Route::get('/proveedores', [ProveedoresController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/create', [ProveedoresController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedoresController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{proveedor}/edit', [ProveedoresController::class, 'edit'])->name('proveedores.edit');
Route::delete('/proveedores/{proveedor}', [ProveedoresController::class, 'destroy'])->name('proveedores.destroy');
Route::put('/proveedores/{proveedor}', [ProveedoresController::class, 'update'])->name('proveedores.update');


