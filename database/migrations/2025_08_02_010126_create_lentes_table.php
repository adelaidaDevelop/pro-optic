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
            $table->string('disenio');
            $table->float('adicion',8,2);
            $table->string('tratamiento');
            $table->float('cyl',8,2);
            $table->float('sph',8,2);
            $table->float('espesor',8,2);
            $table->float('diametro',8,2);
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
