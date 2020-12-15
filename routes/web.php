<?php
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\SubproductoController;
use Illuminate\Support\Facades\Route;

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
//Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/empleado/buscadorEmpleado', [EmpleadoController::class,'buscadorEmpleado']);

Route::get('/departamento/buscador', [DepartamentoController::class,'buscador']);
Route::get('/departamento/buscadorProducto', [CompraController::class,'buscadorProducto']);

Route::get('/departamento/buscador2', [DepartamentoController::class,'buscador2']);

Route::get('/departamento2', [DepartamentoController::class,'index2']);

Route::resource('producto', ProductoController::class);

Route::resource('departamento', DepartamentoController::class);

Route::resource('compra', CompraController::class);

Route::resource('subproducto', SubproductoController::class);

Route::resource('empleado', EmpleadoController::class);

Route::get('emple', [EmpleadoController::class,'index2']);

// RUTA PARA EL BUSCADOR EN TIEMPO REAL DEPARTAMENTO

//


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
