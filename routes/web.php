<?php

use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\EcommerceController;
//use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LoginClienteController;

use Illuminate\Support\Facades\Route;

//ade
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\SubproductoController;
//use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagoCompraController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProductosCaducidadController;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProductoController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
//use Auth;
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
/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes(['verify' => true]);
Route::get('/loginCliente', [LoginClienteController::class, 'loginCliente'])->name('Login'); //->middleware('isCliente');
Route::post('/loginCliente', [LoginClienteController::class, 'loginPost'])->name('Login');
Route::post('/logoutCliente', [LoginClienteController::class, 'logout'])->name('Login');

Route::get('/buscar', [EcommerceController::class, 'buscarProducto'])->middleware('isCliente');
Route::get('/departamento/{departamento}', [EcommerceController::class, 'categoria'])->middleware('isCliente');

Route::post('/agregarAlCarrito/{id}', [EcommerceController::class, 'addCarrito'])->middleware('isCliente');
//Route::resource('/', EcommerceController::class)->middleware('isCliente');
Route::get('/', [EcommerceController::class, 'index'])->middleware('isCliente');

Route::get('/productosNuevos', [EcommerceController::class, 'productosNuevos'])->middleware('isCliente');
Route::get('/productosDestacados', [EcommerceController::class, 'productosDestacados'])->middleware('isCliente');

Route::get('/registerCliente', [LoginClienteController::class, 'register'])->middleware('isCliente');
Route::post('/registerPost', [LoginClienteController::class, 'registerPost'])->middleware('isCliente');

Route::get('/producto/{id}', [EcommerceController::class, 'verProducto'])->middleware('isCliente');
Route::post('/sucursal/{sucursal}', [EcommerceController::class, 'cambiarSucursal'])->middleware('isCliente');
Route::get('/carrito', [EcommerceController::class, 'carrito'])->middleware('isCliente');
Route::post('/actualizarCantidadCarrito/{id}', [EcommerceController::class, 'actualizarCantidadCarrito'])->middleware('isCliente');
Route::post('/quitarProductoCarrito/{id}', [EcommerceController::class, 'quitarProductoDeCarrito'])->middleware('isCliente');

Route::get('/direccionEnvio', [EcommerceController::class, 'direccionEnvio'])->middleware('isCliente'); //->middleware('verified');;
Route::post('/domicilio', [EcommerceController::class, 'postDireccion'])->middleware('isCliente'); //->middleware('verified');;
Route::post('/actualizarDireccion', [EcommerceController::class, 'actualizarDireccion'])->middleware('isCliente'); //->middleware('verified');;

Route::post('/eliminarDireccion', [EcommerceController::class, 'eliminarDireccion'])->middleware('isCliente');
Route::get('/metodoPago', [EcommerceController::class, 'formaPago'])->middleware('isCliente');
Route::get('/revisionPedido', [EcommerceController::class, 'revisionPedido'])->middleware('isCliente');
Route::get('/menu', [EcommerceController::class, 'menu'])->middleware('isCliente'); //->middleware('verified');;
Route::post('/actualizarDatosCliente', [EcommerceController::class, 'actualizarDatosCliente'])->middleware('isCliente');
//Auth::routes();
Route::get('/pagoPaypal', [EcommerceController::class, 'pagoPaypal']);

Route::get('/revisionCompra', [EcommerceController::class, 'revisionCompra']); //->middleware('isCliente');
Route::post('/prueba', [EcommerceController::class, 'insertarSolicitud']); //->middleware('isCliente');
Route::get('/resumenFinal/{id},{folio}', [EcommerceController::class, 'resumen']); //->middleware('isCliente');
Route::get('/verSeguimientoPedido/{id}', [EcommerceController::class, 'verSeguimientoPedido']); //->middleware('isCliente');
Route::get('/comprobante/{id}', [EcommerceController::class, 'generarComprobante']); //->middleware('isCliente');
//Route::get('/verificacionEmail', [EcommerceController::class,'verificacionEmail'])->middleware('isCliente');
Route::get('/busquedaTiempoReal',[EcommerceController::class, 'busquedaTiempoReal']);
Route::get('/home', function () {
    /*$pos1 = strpos(session('urlVerified'), 'verify/');
    $pos1 = $pos1 + 7;
    $pos2 = strpos(session('urlVerified'), '/',$pos1);
    $url = session('urlVerified');
    $id = substr($url, $pos1,$pos2);
    return $pos2.' url: '.$url.'  id:'.$id;
    // = session()('urlVerified');
    $idS = session('idS');
    session()->forget('idS');
    return $idS;*/
    //return session('urlVerified');//$url;
    if (Auth::check()) {
        session()->forget('urlVerified');
        if (Auth::user()->tipo == 0) {
            //session(['idUsuario' =>Auth::user()->id]);

            return redirect('/puntoVenta/login');
        }
        if (Auth::user()->tipo == 2) {
            //session(['idCliente' =>Auth::user()->id]);
            //Auth::logout();
            return redirect('/loginCliente');
        }
    }
    //}
    return NULL;
});
Route::get('/forgot-password', function () {
    return view('auth.reset');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('img/background_punto_venta',function()
{
    return asset('img\background_punto_venta.jpg');
});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
    //return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');*/
Route::get('/clear-cache', function () {
   echo Artisan::call('config:clear');
   echo Artisan::call('config:cache');
   echo Artisan::call('cache:clear');
   echo Artisan::call('route:clear');
})->name('clear.cache');
