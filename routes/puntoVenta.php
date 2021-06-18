<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\VentaController;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\SucursalEmpleadoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\PerdidaController;

//ade
use App\Http\Controllers\CompraController;
use App\Http\Controllers\SubproductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagoCompraController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\HistorialPedidoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ProductosCaducidadController;
use App\Http\Controllers\SucursalProductoController;
use App\Models\Producto;
use App\Models\Sucursal_producto;
use Illuminate\Support\Facades\Route;

Route::prefix('/puntoVenta')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('Login'); //->middleware('isEmpleado');
    Route::post('/login', [LoginController::class, 'loginPost'])->name('Login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('Login');
    //Route::get('/producto/stock', [ProductoController::class,'stock']);

    //Route::middleware('verified')->group(function () {
        Route::middleware('isEmpleado')->group(function () {
            //Rutas ade
            Route::get('/datosDevoluciones', [DevolucionController::class, 'datoDev']);
            Route::get('/datosVentas', [DevolucionController::class, 'datosVenta']);
            Route::get('/datosdetalleVenta', [DevolucionController::class, 'datosDetalleVenta']);
            Route::get('/datosProducto', [DevolucionController::class, 'datosProducto']);
            Route::get('/datosEmpleado', [DevolucionController::class, 'datosEmpleado']);
            Route::get('/departamento2', [DepartamentoController::class, 'index2']);
            Route::post('/venta/productos', [VentaController::class, 'productos']);

            Route::get('emple', [EmpleadoController::class, 'index2']);
            //cargar vista imp corte caja
            Route::get('/corte_cajaView', [ReporteController::class, 'corte_cajaView']);

            Route::resource('credito', CreditoController::class);
            Route::get('/datosNuevos', [CreditoController::class, 'datosNuevos']);
            Route::resource('pago', PagoController::class);
            Route::resource('pagoCompra', PagoCompraController::class);
            Route::resource('devolucion', DevolucionController::class);

            Route::get('/empleado/buscadorEmpleado', [EmpleadoController::class, 'buscadorEmpleado']);
            Route::post('/empleado/editar/{id}', [EmpleadoController::class, 'editarEmpleado']);

            Route::get('/producto/buscarProducto', [ProductoController::class, 'buscarProducto']);

            Route::get('/producto/buscador', [ProductoController::class, 'buscador']);

            Route::get('/departamento/buscador', [DepartamentoController::class, 'buscador']);
            Route::get('/cliente/buscador', [ClienteController::class, 'buscador']);
            Route::get('/administracion/buscador', [AdministracionController::class, 'buscador']);
            Route::resource('departamento', DepartamentoController::class); //->middleware('auth');

            // Route::resource('sucursal', SucursalController::class);
            Route::get('/permisosEmpleado/{id}', [SucursalEmpleadoController::class, 'permisosEmpleado']);
            Route::post('/sucursalEmpleado/editar/{id}', [SucursalEmpleadoController::class, 'editarEmpleado']);
            Route::resource('sucursalEmpleado', SucursalEmpleadoController::class);


            //AGREGAR PRODUCTOS A SUCURSAL DESDE STOCK
            Route::get('/producto/stock', [ProductoController::class, 'stock']);
            Route::get('/producto/stock/{producto}', [ProductoController::class, 'buscarStock']);
            Route::get('/sucursalProducto/crear/{id}', [SucursalProductoController::class, 'crear']);
            //PRODUCTO
            //ADMINISTRADOR ELIMINA UN PRODUCTO DEL STOCK
            Route::get('/productosTodos', [ProductoController::class, 'productosAll']);
            //ELIMINAR PRODUCTO POR EL ADMINISTRADOR DEL STOCK
            Route::get('/eliProd/{id}', [ProductoController::class, 'eliProd']);

            //Sucursal producto
            Route::get('/inventarioRapido/{total}', [SucursalProductoController::class, 'inventarioRapido']);
            Route::get('/sucursalProducto/buscarPorCodigo/{codigo}', [SucursalProductoController::class, 'buscarPorCodigo']);
            Route::resource('sucursalProducto', SucursalProductoController::class);
            //RUTA SUCURSALES INACTIVAS
            Route::get('/sucursalesInactivos', [SucursalController::class, 'sucu_inactivas']);
            // dar alta sucursal
            Route::get('/altaSucursal/{id}', [SucursalController::class, 'darAltaSucursal']);
            //AGREGAR PRODUCTOS DEL STOCK A LA SUCURSAL ACTUAL
            Route::get('/agregarProdStock/{id}', [SucursalProductoController::class, 'agregarProdStock_Suc']);
            //DEVOLVER PRODUCTOS EN BAJA DE ESTA SUCURSAL
            Route::get('productos_baja', [SucursalProductoController::class, 'productos_baja']);
            //DAR DE ALTA PRODUCTOS DADAS DE BAJA EN ESTA SUCURSAL
            Route::get('altaProducto/{id}', [SucursalProductoController::class, 'altaProductoS']);
            //ELIMINAR SUCURSAL PT2
            Route::get('destroy2/{id}', [SucursalController::class, 'destroy2']);
            //dar de baja sucursal
            //clients
            Route::get('/cliente/destroy2/{id}', [ClienteController::class, 'destroy2']);
            Route::get('/cliente/baja/{id}', [ClienteController::class, 'baja']);

            Route::get('actualizar/{id}', [SucursalController::class, 'bajaSucursal']);
            //MODIFICAR COSTO Y PRECIO EN SUCURSAL PRODUCTO
            Route::post('productoSuc/actPrecio/{id}', [SucursalProductoController::class, 'actPrecio']);
            Route::post('productoSuc/actCosto/{id}', [SucursalProductoController::class, 'actCosto']);
            //reemplazar existencia
            Route::post('productoSuc/actExistencia/{id}', [SucursalProductoController::class, 'actExistencia']);
            //actualizar existencia
            Route::post('productoSuc/agregarExistencia/{id}', [SucursalProductoController::class, 'agregarExistencia']);


            Route::get('productoEli/{id}', function ($id) {
                $producto = Sucursal_producto::where('idProducto', '=', $id)->delete();
                return redirect()->back();
            });

            //SUBPRODUCTO
            Route::resource('subproducto', SubproductoController::class);
            Route::get('veriUniqueSubproducto', [SubproductoController::class, 'existeEnSubproducto']);
            Route::post('editarSubproducto/{id}', [SubproductoController::class, 'update']);

            Route::get('subproducto/actExistencia', [SubproductoController::class, 'actExistencia']);
            Route::get('subproductoEli/{id}', [SubproductoController::class, 'eliminar']);
            Route::get('subprodExisNueva/{id}', [SubproductoController::class, 'subprodExisNueva']);
            Route::get('subProdExisStock/{id}', [SubproductoController::class, 'subProdExisStock']);
            Route::post('subProdExisNuevo/{id}', [SubproductoController::class, 'subProdExisNuevo']);

            //RUTAS PARA SEGUIMIENTO DE PEDIDOS ECOMMERCE
            Route::get('seguimiento/pedido', [HistorialPedidoController::class, 'index']);
            Route::get('historial/pedido', [HistorialPedidoController::class, 'index2']);
            Route::get('comprobante', [HistorialPedidoController::class, 'index3']);
            Route::get('/descComprobante', [HistorialPedidoController::class, 'download2']);
            Route::get('/pdf2', [ReporteController::class, 'pdf']);

            //ruta para cargar header_foter
            Route::post('encabezado_pie', [ReporteController::class, 'encabezadoPag']);
            //ELIMINAR PRODUCTOS DE SUCURSAL
            Route::get('productoEli3/{id}', [ProductoController::class, 'eliminar3']);
            Route::resource('cliente', ClienteController::class);
            Route::resource('corteCaja', ReporteController::class);
            Route::get('reporteInventario', [ReporteController::class, 'index2']);
            Route::get('reporteVentas', [ReporteController::class, 'index3']);
            Route::get('reporteCompraVenta', [ReporteController::class, 'index4']);
            Route::get('act_inventario', [SucursalProductoController::class, 'act_inventario']);
            //imprimir directo
            Route::get('impDirecto', [VentaController::class, 'imprimirPrueba']);

            //RUTA IMPRIMIR CORTE CAJA
            Route::get('imp_corteCaja', [ReporteController::class, 'pdf']);

            Route::get('histo_venta', [ReporteController::class, 'histoVenta']);

            //Route::get('eliminar/{id}', [ProductoController::class,'eliminar']);
            Route::resource('sucursal', SucursalController::class);

            // Route::middleware('verified')->group(function () {
            Route::post('/oferta/editar/{id}', [OfertaController::class, 'update']);
            Route::post('/sucursalProducto/editar/{id}', [SucursalProductoController::class, 'update']);
            Route::post('/producto/editar/{id}', [ProductoController::class, 'update']);

            Route::get('empleado/validarClave/{clave}', [EmpleadoController::class, 'validarClave']);
            Route::get('empleado/claveEmpleado/{clave}', [EmpleadoController::class, 'validarEmpleado']);
            //Route::get('administracion', [AdministracionController::class,'index']);
            Route::resource('administracion', AdministracionController::class);
            Route::resource('perdida', PerdidaController::class);
            Route::resource('producto', ProductoController::class);
            Route::resource('empleado', EmpleadoController::class);
            //Route::get('/login', [LoginController::class,'login'])->name('Login');
            //->middleware('isEmpleado');
            Route::resource('venta', VentaController::class);
            Route::post('/compra/editar/{id}', [CompraController::class, 'estadoCompra']);

            //Recuperar ventas ecommerce activos para seguimiento
            Route::get('/seguimientoPedidosActivos', [VentaController::class, 'buscador2']);
            Route::get('/ventaPedidos', [VentaController::class, 'buscador']);
            //Darle funcionalidad a cadapedido
            Route::get('/verSeguimiento/{id}', [VentaController::class, 'darSeguimiento']);
            //Actualizar estado de los pedidos
            Route::post('/actEstadoPed', [VentaController::class, 'act_est_paq']);


            Route::resource('compra', CompraController::class);
            Route::get('/proveedor/buscador', [ProveedorController::class, 'buscador']);
            Route::post('/proveedor/editar/{id}', [ProveedorController::class, 'editarProveedor']);
            Route::resource('proveedor', ProveedorController::class);
            //   Route::get('proximosACaducar', [ProductosCaducidadController::class,'caducidad']);;///

            Route::resource('oferta', OfertaController::class);
            Route::post('/productosCaducidad/editar/{id}', [ProductosCaducidadController::class, 'editarCaducidad']);
            Route::resource('productosCaducidad', ProductosCaducidadController::class);
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
            Route::get('/ecommerce/administracion', [App\Http\Controllers\EcommerceController::class, 'administracion']);
            Route::post('/ecommerce/departamentos', [App\Http\Controllers\EcommerceController::class, 'actualizarDepartamentos']);
            Route::post('/actualizarCantidadPedidoProducto', [App\Http\Controllers\VentaController::class, 'actualizarCantidadPedidoProducto']);
            Route::post('/quitarProductoPedido', [App\Http\Controllers\VentaController::class, 'quitarProductoPedido']);
            Route::post('/aceptarPedido/{id}', [App\Http\Controllers\VentaController::class, 'aceptarPedido']);
            Route::post('/rechazarPedido/{id}', [App\Http\Controllers\VentaController::class, 'rechazarPedido']);
        });
    //});
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
            
    Route::post('/pedidosTiempoReal', [App\Http\Controllers\VentaController::class, 'pedidosTiempoReal']);
});
