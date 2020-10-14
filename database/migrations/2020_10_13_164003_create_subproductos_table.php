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
            $table->engine = 'InnoDB';
            $table->integer('piezas');
            $table->double('precio_ind');
            $table->string('descripcion');
            $table->string('medida');
            $table->integer('existencia');
            $table->double('ganancia');
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
        Schema::dropIfExists('subproductos');

    }
    
}
