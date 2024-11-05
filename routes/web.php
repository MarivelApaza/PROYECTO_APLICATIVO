<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;


Route::get('/', function () {
    return view('index');
});

Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/producto/create', [ProductoController::class, 'create'])->name('producto.create');
Route::post('/producto/store', [ProductoController::class, 'store'])->name('producto.store');
Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');
Route::get('producto/edit/{id}', [ProductoController::class, 'edit'])->name('producto.edit');
Route::put('producto/update/{id}', [ProductoController::class, 'update'])->name('producto.update');


Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente/store', [ClienteController::class, 'store'])->name('cliente.store');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');
Route::get('cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('cliente/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');

Route::get('/proveedor', [ProveedorController::class, 'index'])->name('proveedor.index');
Route::get('/proveedor/create', [ProveedorController::class, 'create'])->name('proveedor.create');
Route::post('/proveedor/store', [ProveedorController::class, 'store'])->name('proveedor.store');
Route::delete('/proveedor/{id}', [ProveedorController::class, 'destroy'])->name('proveedor.destroy');
Route::get('proveedor/edit/{id}', [ProveedorController::class, 'edit'])->name('proveedor.edit');
Route::put('proveedor/update/{id}', [ProveedorController::class, 'update'])->name('proveedor.update');