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
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('nombre')->unique();
            $table->string('descripcion');
            $table->integer('minimo_stock');
            $table->unsignedInteger('existencia');
            $table->timestamps();
            if (Schema::hasTable('departamentos')) {
                $table->foreignId('departamentos_id')->nullable()->constrained('departamentos');
            }
            if (Schema::hasTable('subproductos')) {
                if (!Schema::hasColumn('subproductos', 'productos_id')) {
                    $table->foreignId('productos_id')->nullable()->constrained('productos');
                }
            }
            if (Schema::hasTable('detalle_productos')) {
                if (!Schema::hasColumn('detalle_productos', 'productos_id')) {
                    $table->foreignId('productos_id')->nullable()->constrained('productos');
                }
            }
            if (Schema::hasTable('compra_productos')) {
                if (!Schema::hasColumn('compra_productos', 'productos_id')) {
                    $table->foreignId('productos_id')->nullable()->constrained('productos');
                }
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
        
        Schema::dropIfExists('productos');
    }
}
