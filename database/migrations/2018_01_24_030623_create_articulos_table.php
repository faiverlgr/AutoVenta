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
            $table->string('nomarti', 80)->required();
            $table->string('nomartic', 50)->nullable();
            $table->decimal('vcosto', 11, 2)->required();
            $table->decimal('vneto', 11, 2)->required();
            $table->decimal('piva', 5, 2)->required();
            $table->decimal('pmargen', 5, 2)->required();
            $table->mediumInteger('minimo')->required();
            $table->mediumInteger('maximo')->required();
            $table->smallInteger('embalaje')->required();
            $table->string('unidad', 50)->nullable();
            $table->string('cbarras', 50)->nullable();
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
