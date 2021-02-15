<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
         //   $table->string('descripcion')->nullable();
            $table->foreignId('idCliente')->constrained('clientes');
            $table->foreignId('idVenta')->constrained('ventas');
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
        Schema::dropIfExists('creditos');
    }
}
