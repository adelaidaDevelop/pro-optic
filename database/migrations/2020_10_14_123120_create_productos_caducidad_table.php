<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosCaducidadTable extends Migration
{
    /**
     * 
     * 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_caducidad', function (Blueprint $table) {
           // $table->foreign('id')->references('id')->on('productoos');
           $table->foreignId('idProducto')->constrained('productos');
            $table->date('fecha_caducidad');
            $table->integer('cantidad');
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
        Schema::dropIfExists('productos_caducidad');
    }
}
