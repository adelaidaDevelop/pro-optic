<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolucions', function (Blueprint $table) {
            $table->foreignId('idVenta')->constrained('ventas');
            $table->foreignId('idProducto')->constrained('productos');
            $table->foreignId('idEmpSuc')->constrained('sucursal_empleados');
            $table->double('precio', 6, 2);
            $table->unsignedInteger('cantidad');
            $table->string('observacion');
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
        Schema::dropIfExists('devolucions');
    }
}
