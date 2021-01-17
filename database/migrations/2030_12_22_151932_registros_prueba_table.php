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
        User::create([
            'username' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
        ]);

        //CREACION DE EMPLEADOS
        $usuario = User::create([
            'username' => 'Heber',
            'email' => 'hzhm1997@gmail.com',
            'password' => Hash::make('heber12345'),
        ]);

        $empleado = new Empleado;
        $empleado->nombre = 'Heber Zabdiel';
        $empleado->apellidos = 'Hernandez Martinez';
        $empleado->claveE = '12345';
        $empleado->telefono = '9513547350';
        $empleado->cargo = 'cajero';
        $empleado->curp = 'HEMH970804HOCRRB00';
        $empleado->domicilio = 'VALERIO TRUJANO 318';
        $empleado->idUsuario = $usuario->id;
        $empleado->status = 'activo';
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
        $producto->existencia = 12;
        $producto->costo = 15;
        $producto->precio = 18;
        $producto->save();

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
