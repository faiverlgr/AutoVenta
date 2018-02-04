<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codprov', 2)->required();
            $table->string('codcate', 4)->required();
            $table->string('codarti', 4)->required();
            $table->string('nombre', 100)->required();
            $table->string('nombrec', 50);
            $table->decimal('vcosto', 11, 2)->required();
            $table->decimal('vneto', 11, 2)->required();
            $table->decimal('piva', 5, 2)->required();
            $table->decimal('pmargen', 5, 2)->required();
            $table->string('unidad', 50)->required();
            $table->mediumInteger('minimo');
            $table->mediumInteger('maximo');
            $table->smallInteger('embalaje');
            $table->string('cbarras', 50);
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
}
