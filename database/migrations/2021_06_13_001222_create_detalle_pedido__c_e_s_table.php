<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedidoCESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedido__c_e_s', function (Blueprint $table) {
            $table->foreignId('idPedido')->constrained('pedido_contra_entregas');
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
        Schema::dropIfExists('detalle_pedido__c_e_s');
    }
}
