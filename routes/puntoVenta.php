<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\VentaController;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\Auth\LoginController;


use Illuminate\Support\Facades\Route;
Route::prefix('/puntoVenta')->group(function()
{
    Route::resource('departamento', DepartamentoController::class);//->middleware('auth');

    Route::resource('sucursal', SucursalController::class);

    Route::get('/login', [LoginController::class,'login'])->name('Login');//->middleware('isEmpleado');
    Route::post('/login', [LoginController::class,'loginPost'])->name('Login');
    Route::post('/logout', [LoginController::class,'logout'])->name('Login');
    
    
    Route::middleware('isEmpleado')->group(function () {
        Route::resource('empleado', EmpleadoController::class);
        //Route::get('/login', [LoginController::class,'login'])->name('Login');
        //->middleware('isEmpleado');
        Route::resource('venta', VentaController::class);
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});