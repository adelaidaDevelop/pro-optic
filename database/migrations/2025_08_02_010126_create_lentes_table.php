<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lentes', function (Blueprint $table) {
            $table->id();
            $table->string('material');
            $table->string('diseño');
            $table->string('adición');
            $table->string('tratamiento');
            $table->float('CYL',8,2);
            $table->float('SPH',8,2);
            $table->timestamps();
            $table->foreignId('idProducto')->constrained('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lentes');
    }
}
