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
            $table->id();
            $table->foreignId('idSucursalProducto')->constrained('sucursal_productos');
            $table->unsignedInteger('cantidad');
            $table->date('fecha_caducidad');
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
