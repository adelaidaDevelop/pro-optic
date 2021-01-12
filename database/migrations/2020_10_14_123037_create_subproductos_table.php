<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subproductos', function (Blueprint $table) {
           // $table->foreign('id')->references('id')->on('productoos');
           // $table->foreign('id')->references('id')->on('productoos');
            $table->foreignId('idProductos')->constrained('productos');
            $table->integer('piezas');
            $table->double('precio_ind');
            $table->double('costo_ind');
            $table->string('observacion');
            $table->integer('existencia');
            $table->double('ganancia');
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
        Schema::dropIfExists('subproductos');
    }
}
