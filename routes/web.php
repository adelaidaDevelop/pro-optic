<?php

use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\EcommerceController;

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
use Illuminate\Support\Facades\Password;
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
Route::get('/loginCliente', [LoginClienteController::class,'loginCliente'])->name('Login');//->middleware('isCliente');
Route::post('/loginCliente', [LoginClienteController::class,'loginPost'])->name('Login');
Route::post('/logoutCliente', [LoginClienteController::class,'logout'])->name('Login');

Route::get('/buscar', [EcommerceController::class,'buscarProducto'])->middleware('isCliente');
Route::get('/departamento/{departamento}', [EcommerceController::class,'categoria'])->middleware('isCliente');

Route::post('/agregarAlCarrito/{id}', [EcommerceController::class,'addCarrito'])->middleware('isCliente');
//Route::resource('/', EcommerceController::class)->middleware('isCliente');
Route::get('/', [EcommerceController::class,'index'])->middleware('isCliente');

Route::get('/productosNuevos', [EcommerceController::class,'productosNuevos'])->middleware('isCliente');
Route::get('/productosDestacados', [EcommerceController::class,'productosDestacados'])->middleware('isCliente');

Route::get('/registerCliente', [LoginClienteController::class,'register'])->middleware('isCliente');
Route::post('/registerPost', [LoginClienteController::class,'registerPost'])->middleware('isCliente');

Route::get('/producto/{id}', [EcommerceController::class,'verProducto'])->middleware('isCliente');
Route::post('/sucursal/{sucursal}', [EcommerceController::class,'cambiarSucursal'])->middleware('isCliente');
Route::get('/carrito', [EcommerceController::class,'carrito'])->middleware('isCliente');
Route::post('/actualizarCantidadCarrito/{id}', [EcommerceController::class,'actualizarCantidadCarrito'])->middleware('isCliente');
Route::post('/quitarProductoCarrito/{id}', [EcommerceController::class,'quitarProductoDeCarrito'])->middleware('isCliente');

Route::get('/direccionEnvio', [EcommerceController::class,'direccionEnvio'])->middleware('isCliente');//->middleware('verified');;
Route::post('/domicilio', [EcommerceController::class,'postDireccion'])->middleware('isCliente');//->middleware('verified');;
Route::post('/actualizarDireccion', [EcommerceController::class,'actualizarDireccion'])->middleware('isCliente');//->middleware('verified');;

<<<<<<< HEAD
Route::post('/eliminarDireccion', [EcommerceController::class,'eliminarDireccion'])->middleware('isCliente');
Route::get('/metodoPago', [EcommerceController::class,'formaPago'])->middleware('isCliente');
Route::get('/revisionPedido', [EcommerceController::class,'revisionPedido'])->middleware('isCliente');
Route::get('/menu', [EcommerceController::class,'menu'])->middleware('isCliente');//->middleware('verified');;
Route::post('/actualizarDatosCliente', [EcommerceController::class,'actualizarDatosCliente'])->middleware('isCliente');
=======
Route::post('/eliminarDireccion', [EcommerceController::class,'eliminarDireccion']);//->middleware('isCliente');
Route::get('/metodoPago', [EcommerceController::class,'formaPago']);//->middleware('isCliente');
Route::get('/revisionPedido', [EcommerceController::class,'revisionPedido']);//->middleware('isCliente');
Route::get('/menu', [EcommerceController::class,'menu']);//->middleware('isCliente')//->middleware('verified');;
Route::post('/actualizarDatosCliente', [EcommerceController::class,'actualizarDatosCliente']);//->middleware('isCliente');
>>>>>>> 5df6b52543b72e32a0d8c7435136e81254fbb976
//Auth::routes();
Route::get('/pagoPaypal', [EcommerceController::class,'pagoPaypal']);

Route::get('/revisionCompra', [EcommerceController::class,'revisionCompra']);//->middleware('isCliente');
Route::post('/prueba', [EcommerceController::class,'insertarSolicitud']);//->middleware('isCliente');
Route::get('/resumenFinal/{id},{folio}', [EcommerceController::class,'resumen']);//->middleware('isCliente');
Route::get('/verSeguimientoPedido/{id}', [EcommerceController::class,'verSeguimientoPedido']);//->middleware('isCliente');
Route::get('/comprobante/{id}', [EcommerceController::class,'generarComprobante']);//->middleware('isCliente');
//Route::get('/verificacionEmail', [EcommerceController::class,'verificacionEmail'])->middleware('isCliente');
Route::get('/home',function()
{
    //$url = session('urlSeccion');
    //session()->forget('seccion');
    /*$pos = strpos(session('urlSeccion'), 'puntoVenta');
    if ($pos === false) {
        session(['seccion' => 'ecommerce']);
    } else {
        session(['seccion' => 'puntoVenta']);
    }*/
    //return session('urlSeccion');//$pos;*/

    /*$url = session('urlSeccion');
    $urlV = session('urlVerified');
        $seccion = session('seccion');
        session()->forget('urlSeccion');
        session()->forget('seccion');
        $user='no hay ussuario';
        if(Auth::check())
            $user = Auth::user()->id;
        return 'seccion:'.$seccion.' url:'.$url.' sesion:'.$user.' urlVerified:'.$urlV; */
    /*if(session()->has('seccion'))
    {
        $url = session('urlSeccion');
        $seccion = session('seccion');
        session()->forget('urlSeccion');
        session()->forget('seccion');
        //return $url;
        if(session('seccion') == 'ecommerce')
        {
            session()->forget('urlSeccion');
            session()->forget('seccion');
            return redirect('/menu');
        }
        if(session('seccion') == 'puntoVenta')
        {
            session()->forget('urlSeccion');
            session()->forget('seccion');
            return redirect('/puntoVenta/home');
        }
    }else
    {*/
        if(Auth::check())
        {
            session()->forget('urlVerified');
            if(Auth::user()->tipo == 0)
            {
                //session(['idUsuario' =>Auth::user()->id]);
                Auth::logout();
                return redirect('/puntoVenta/login');
            }
            if(Auth::user()->tipo == 2)
            {
                //session(['idCliente' =>Auth::user()->id]);
                Auth::logout();
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