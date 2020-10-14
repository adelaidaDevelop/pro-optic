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
            $table->engine = 'InnoDB';
            $table->integer('cantidad');
            $table->integer('porcentaje_ganancia');
            $table->dateTime('fecha_caducidad');
            $table->double('costo_unitario');
            $table->string('iva');
            $table->timestamp('fecha_registro');
            if (Schema::hasTable('compras')) {
                $table->foreignId('compras_id')->nullable()->constrained('compras');
            }
            if (Schema::hasTable('productos')) {
                $table->foreignId('productos_id')->nullable()->constrained('productos');
            }
            
       
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
