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
            $table->string('primerNombre');
        $table->string('segundoNombre');
            $table->string('apellidoPaterno');
            $table->string('apellidoMaterno');
        $table->string('genero',1);
        $table->date('fechaNacimiento');

        $table->string('entidadFederativa',2);
            $table->string('curp');
            $table->string('telefono');
            $table->string('domicilio');
            $table->string('claveE',5)->unique();
            //$table->string('status');
            $table->foreignId('idUsuario')->constrained('users');
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
