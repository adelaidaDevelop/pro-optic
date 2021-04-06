<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigoBarras')->unique();
            $table->string('nombre')->unique();
            $table->string('imagen')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('receta');
            //$table->integer('minimo_stock');
            //$table->double('costo', 6, 2);
            //$table->double('precio', 6, 2);
            $table->foreignId('idDepartamento')->constrained('departamentos');
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
        Schema::dropIfExists('productoos');
    }
}
