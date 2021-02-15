<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->foreignId('idCompra')->constrained('compras');
            $table->foreignId('idProducto')->constrained('productos');
            $table->double('costo_unitario');
            $table->integer('cantidad');
            $table->integer('porcentaje_ganancia');
            //$table->date('fecha_caducidad');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_compras');
    }
}
