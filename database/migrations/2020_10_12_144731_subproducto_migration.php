<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubproductoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subproducto', function (Blueprint $table) {
            $table->foreign('id_producto')->references('id_producto')->on('producto');
            $table->integer('piezas');
            $table->double('precio_ind');
            $table->string('descripcion');
            $table->string('medida');
            $table->integer('existencia');
            $table->double('ganancia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subproducto');
    }
}
