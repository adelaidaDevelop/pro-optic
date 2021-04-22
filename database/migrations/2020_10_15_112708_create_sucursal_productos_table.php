<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursal_productos', function (Blueprint $table) {
            $table->id();
            $table->float('costo',8,2);
            $table->float('precio',8,2);
            $table->unsignedInteger('existencia');
            $table->unsignedInteger('minimoStock');
            $table->unsignedInteger('status');
            $table->foreignId('idSucursal')->constrained('sucursals');
            $table->foreignId('idProducto')->constrained('productos');
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
        Schema::dropIfExists('sucursal_productos');
    }
}
