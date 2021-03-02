<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Sucursal;
use App\Models\Sucursal_producto;
use App\Models\Sucursal_empleado;

class RegistrosPruebaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //CREACION DE SUCURSAL
        $sucursal = new Sucursal;
        $sucursal->direccion ='SAN FELIPE 23, SAN MARTIN MEXICAPAN';
        $sucursal->telefono = '9512456511';
        $sucursal->status = 1;
        $sucursal->save();
        //CREACION DE ADMINISTRADOR
        $admin = User::create([
            'username' => 'ADMINISTRADOR',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
            'tipo' => 0,
        ]);
        //CREACION USUARIO ADMIN P/DEUDORES
        $admin = User::create([
            'username' => 'DEUDOR',
            'email' => 'deudor@gmail.com',
            'password' => Hash::make('deudor12345'),
            'tipo' => 1,
        ]);

        $empleadoAdmin = new Empleado;
        $empleadoAdmin->nombre = 'XXXXX';
        $empleadoAdmin->apellidoPaterno = 'XXXXX';
        $empleadoAdmin->apellidoMaterno = 'XXXXX';
        $empleadoAdmin->curp = 'XXXXXXXXXXXXXXXXXX';
        $empleadoAdmin->telefono = '0000000000';
        $empleadoAdmin->domicilio = 'XXXXXXXXXXXX';
        $empleadoAdmin->claveE = '12345';
        //$empleadoAdmin->status = 'alta';
        $empleadoAdmin->idUsuario = $admin->id;
        $empleadoAdmin->save();

        $sucursalEmpleado = new Sucursal_empleado;
        $sucursalEmpleado->idSucursal = $sucursal->id;
        $sucursalEmpleado->idEmpleado = $empleadoAdmin->id;
        $sucursalEmpleado->status = 'alta';
        $sucursalEmpleado->save();
        //CREACION DE EMPLEADOS
        /*$usuario = User::create([
            'username' => 'Heber',
            'email' => 'hzhm1997@gmail.com',
            'password' => Hash::make('heber12345'),
            'tipo' => 2
        ]);

        $empleado = new Empleado;
        $empleado->nombre = 'Heber Zabdiel';
        $empleado->apellidoPaterno = 'Hernandez';
        $empleado->apellidoMaterno = 'Martinez';
        $empleado->curp = 'HEMH970804HOCRRB00';
        $empleado->telefono = '9513547350';
        $empleado->domicilio = 'Valerio trujano 318, barrio san Juan, zimatlan';
        $empleado->claveE = '12345';
        $empleado->status = 'alta';
        $empleado->idUsuario = $usuario->id;
        $empleado->save();
*/
        //CREACION DE DEPARTAMENTOS
        $departamento = Departamento::create(
            ['nombre' => 'SIN DEPARTAMENTO',
             'status' => 1]
        );
        $departamento = Departamento::create(
            ['nombre' => 'VENTA LIBRE',
             'status' => 1]
        );
        $departamento = Departamento::create(
            ['nombre' => 'PERFUMERIA',
             'status' => 1]
        );
        $departamento = Departamento::create(
            ['nombre' => 'PATENTE',
            'status' => 1]
        );

        //CREACION DE PRODUCTOS
        $producto = new Producto;
        $producto->codigoBarras = '7501607705006';
        $producto->nombre = 'ALCOHOL ROJO 96 500ML';
        $producto->imagen = 'uploads\zMlAh4qsuAy38QGtRaABBogpx7rYeKIW6xSTXfKj.jpg';
        $producto->descripcion = 'ETILICO SIN DESNATURALIZAR';
        $producto->receta = 'NO';
        $producto->idDepartamento = $departamento->id;
    //  $producto->minimo_stock = 10;
        //$producto->existencia = 12;
      //  $producto->costo = 15;
      //  $producto->precio = 18;
        $producto->save();
        $producto2 = new Producto;
        $producto2->codigoBarras = '759684437151';
        $producto2->nombre = 'ACETONA JALOMA 120ml';
        $producto2->imagen = 'uploads\zMlAh4qsuAy38QGtRaABBogpx7rYeKIW6xSTXfKj.jpg';
        $producto2->descripcion = 'ETILICO SIN DESNATURALIZAR';
        $producto2->receta = 'NO';
        $producto2->idDepartamento = $departamento->id;
     //   $producto2->minimo_stock = 10;
        //$producto->existencia = 12;
      //  $producto2->costo = 8;
       // $producto2->precio = 15;
        $producto2->save();

        //CREACION DE PROVEEDOR
        Proveedor::create([
                'rfc' => 'DF5DF5DFDS5F',
                'nombre' => 'MARZAM',
                'telefono' => '9516457898',
                'direccion' => 'Sin especificar',
                'status' => true
            ]);

        Proveedor::create([
                'rfc' => 'D6S568D6FSD4',
                'nombre' => 'NIVEA',
                'telefono' => '9547894563',
                'direccion' => 'Sin especificar',
                'status' => true
            ]);

        //CREACION DE CLIENTE
        /*$cliente = new Cliente;
        $cliente->nombre = 'ADELAIDA MOLINA REYES';
        $cliente->telefono = '9512274920';
        $cliente->domicilio = 'SIN ESPECIFICAR';
        $cliente->idUsuario = $usuario->id;
        $cliente->save();
*/
        

        $productosSucursal = new Sucursal_producto;
        $productosSucursal->costo = 10;
        $productosSucursal->precio = 10;
        $productosSucursal->existencia = 10;
        $productosSucursal->minimoStock = 10;
        $productosSucursal->status = 1;
        $productosSucursal->idSucursal= $sucursal->id;
        $productosSucursal->idProducto= $producto->id;
        $productosSucursal->save();

        $productosSucursal2 = new Sucursal_producto;
        $productosSucursal2->costo = 5;
        $productosSucursal2->precio = 15;
        $productosSucursal2->existencia = 8;
        $productosSucursal2->minimoStock = 6;
        $productosSucursal2->status = 1;
        $productosSucursal2->idSucursal= $sucursal->id;
        $productosSucursal2->idProducto= $producto2->id;
        $productosSucursal2->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
}
