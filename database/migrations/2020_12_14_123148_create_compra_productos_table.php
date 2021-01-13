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
           // $table->foreign('id')->references('id')->on('compraas');
            $table->foreignId('idCompras')->constrained('compras');
           // $table->foreign('id')->references('id')->on('productoos');
            $table->foreignId('idProductos')->constrained('productos');
            $table->integer('cantidad');
            $table->integer('porcentaje_ganancia');
            $table->date('fecha_caducidad');
            $table->double('costo_unitario');
            $table->string('iva');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_productoos');
    }
}
