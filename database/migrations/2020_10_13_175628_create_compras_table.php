<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('proveedor');
            $table->timestamps();
            if (Schema::hasTable('compra_porductos')) {
                if (!Schema::hasColumn('compra_productos', 'compras_id')) {
                    $table->foreignId('compras_id')->nullable()->constrained('compras');
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
        Schema::dropIfExists('compras');
    }
}
