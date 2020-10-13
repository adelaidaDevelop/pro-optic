<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_productos', function (Blueprint $table) {
            $table->foreign('id_compra')->references('id_compra')->on('compra');
            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->integer('cantidad');
            $table->integer('porcentaje_ganancia');
            $table->timestamp('fecha_caducidad');
            $table->double('costo_unitario');
            $table->string('iva');
            $table->timestamp('fecha_registro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_productos');
    }
}
