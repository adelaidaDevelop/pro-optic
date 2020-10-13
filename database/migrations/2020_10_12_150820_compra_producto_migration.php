<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompraProductoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_producto', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('compra');
            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->integer('cantidad');
            $table->integer('porcentaje_ganancia');
            $table->timestamps('fecha_caducidad');
            $table->double('costo_unitario');
            $table->string('iva');
            $table->timestamps('fecha_registro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_producto');
    }
}
