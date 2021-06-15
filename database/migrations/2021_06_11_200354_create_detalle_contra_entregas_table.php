<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleContraEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_contra_entregas', function (Blueprint $table) {
            $table->foreignId('idPedido')->constrained('pedidoContraEntregas');
            $table->foreignId('idSucProd')->constrained('sucursal_productos');
            $table->float('precio',8,2);
            $table->unsignedInteger('cantidad');
            $table->float('subtotal',8,2);
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
        Schema::dropIfExists('detalle_contra_entregas');
    }
}
