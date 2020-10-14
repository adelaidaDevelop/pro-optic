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
            $table->timestamp('fecha_caducidad');
            $table->double('costo_unitario');
            $table->string('iva');
<<<<<<< HEAD:database/migrations/2020_10_13_175843_create_compra_productos_table.php
            $table->timestamp('fecha_registro');
            if (Schema::hasTable('compras')) {
                $table->foreignId('compras_id')->nullable()->constrained('compras');
            }
            if (Schema::hasTable('productos')) {
                $table->foreignId('productos_id')->nullable()->constrained('productos');
            }
        }
=======
            //$table->timestamp('fecha_registro');
>>>>>>> 76dad42f1cca359af34bd91adf4b93f7ad7c45eb:database/migrations/2020_10_14_123148_create_compra_productos_table.php
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
