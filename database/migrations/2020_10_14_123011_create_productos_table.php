<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            //$table->id('id_producto');
            //$table->foreign('id_departamento')->references('id_departamento')->on('departamentoos');
            $table->foreignId('idDepartamento')->constrained('departamentos');
           // $table->foreign('id')->references('id')->on('departamentoos');
            $table->string('nombre')->unique();
            $table->string('descripcion');
            $table->integer('minimo_stock');
            $table->unsignedInteger('existencia');
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
        Schema::dropIfExists('productoos');
    }
}
