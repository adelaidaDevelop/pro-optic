<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\SucursalController;


use Illuminate\Support\Facades\Route;


Route::resource('departamento', DepartamentoController::class)->middleware('auth');

Route::resource('sucursal', SucursalController::class);