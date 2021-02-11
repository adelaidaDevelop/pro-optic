<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->String('claveE')->unique();
            $table->string('telefono');
            //$table->string('cargo');
            $table->string('curp');
            $table->string('domicilio');
            $table->foreignId('idUsuario')->constrained('users');
           // $table->string('usuario');
           // $table->string('contra');
            //$table->string('correo');
            
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
