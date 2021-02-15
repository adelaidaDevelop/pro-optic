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

class RegistrosPruebaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //CREACION DE USUARIOS
        /*User::create([
            'username' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
            'tipo' => 0,

        ]);

        //CREACION DE EMPLEADOS
        $usuario = User::create([
            'username' => 'Heber',
            'email' => 'hzhm1997@gmail.com',
            'password' => Hash::make('heber12345'),
            'tipo' => 2
        ]);

        $empleado = new Empleado;
        $empleado->nombre = 'Heber Zabdiel';
        $empleado->apellidos = 'Hernandez Martinez';
        $empleado->claveE = '12345';
        $empleado->telefono = '9513547350';
        $empleado->curp = 'HEMH970804HOCRRB00';
        $empleado->domicilio = 'VALERIO TRUJANO 318';
        $empleado->idUsuario = $usuario->id;
        $empleado->status = 'alta';
        $empleado->save();

        //CREACION DE DEPARTAMENTOS
        $departamento = Departamento::create(
            ['nombre' => 'VENTA LIBRE']
        );
        $departamento = Departamento::create(
            ['nombre' => 'PERFUMERIA']
        );
        $departamento = Departamento::create(
            ['nombre' => 'PATENTE']
        );

        //CREACION DE PRODUCTOS
        $producto = new Producto;
        $producto->idDepartamento = $departamento->id;
        $producto->codigoBarras = '7501607705006';
        $producto->nombre = 'ALCOHOL ROJO 96 500ML';
        $producto->receta = 'NO';
        $producto->descripcion = 'ETILICO SIN DESNATURALIZAR';
        $producto->imagen = 'uploads\zMlAh4qsuAy38QGtRaABBogpx7rYeKIW6xSTXfKj.jpg';
        $producto->minimo_stock = 10;
        //$producto->existencia = 12;
        $producto->costo = 15;
        $producto->precio = 18;
        $producto->save();
        
        $producto2 = new Producto;
        $producto2->idDepartamento = $departamento->id;
        $producto2->codigoBarras = '759684437151';
        $producto2->nombre = 'ACETONA JALOMA 120ml';
        $producto2->receta = 'NO';
        $producto2->descripcion = 'ETILICO SIN DESNATURALIZAR';
        $producto2->imagen = 'uploads\zMlAh4qsuAy38QGtRaABBogpx7rYeKIW6xSTXfKj.jpg';
        $producto2->minimo_stock = 10;
        //$producto->existencia = 12;
        $producto2->costo = 8;
        $producto2->precio = 15;
        $producto2->save();


        //CREACION DE PROVEEDOR
        Proveedor::create([
                'rfc' => 'DF5DF5DFDS5F',
                'nombre' => 'MARZAM',
                'telefono' => '9516457898',
                'direccion' => 'Muchos lugares'
            ]);

        Proveedor::create([
                'rfc' => 'D6S568D6FSD4',
                'nombre' => 'NIVEA',
                'telefono' => '9547894563',
                'direccion' => 'Muchos lugares de qui'
            ]);

        //CREACION DE CLIENTE
        $cliente = new Cliente;
        $cliente->nombre = 'ADELAIDA MOLINA REYES';
        $cliente->telefono = '9512274920';
        $cliente->save();

        $sucursal = new Sucursal;
        $sucursal->direccion ='SAN FELIPE 23, SAN MARTIN MEXICAPAN';
        $sucursal->telefono = '9512456511';
        $sucursal->save();

        $productosSucursal = new Sucursal_producto;
        $productosSucursal->idSucursal= $sucursal->id;
        $productosSucursal->idProducto= $producto->id;
        $productosSucursal->existencia = 10;
        $productosSucursal->save();

        $productosSucursal2 = new Sucursal_producto;
        $productosSucursal2->idSucursal= $sucursal->id;
        $productosSucursal2->idProducto= $producto2->id;
        $productosSucursal2->existencia = 10;
        $productosSucursal2->save();

            */
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
