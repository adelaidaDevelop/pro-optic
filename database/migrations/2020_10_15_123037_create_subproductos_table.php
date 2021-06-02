<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subproductos', function (Blueprint $table) {
            $table->foreignId('idSucursalProducto')->constrained('sucursal_productos');
            $table->integer('piezas');
            $table->double('precio');
            $table->unsignedInteger('existencia');
            $table->string('observacion')->nullable();
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
        Schema::dropIfExists('subproductos');
    }
}
