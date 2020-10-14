<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('codigo_barras')->unique();
            $table->integer('existencia');
            $table->string('imagen');
            $table->timestamps();
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
        
        Schema::dropIfExists('detalle_productos');
    }
}
