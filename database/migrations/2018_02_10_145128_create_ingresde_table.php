<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresdeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresde', function (Blueprint $table) {
            $table->integer('iden')->required();
            $table->integer('idbod')->required()->default(1);
            $table->integer('idarti')->required();
            $table->decimal('cantidad', 11, 2)->required();
            $table->decimal('vcosto', 11, 2)->required();
            $table->decimal('vneto', 11, 2)->required();
            $table->decimal('piva', 5, 2)->required();
            $table->decimal('vtotal', 11, 2)->required();
            $table->decimal('vtmarg', 11, 2)->required();
        });
        Schema::table('ingresde', function (Blueprint $table) {
            $table->index('idarti');
            $table->index(['idbod', 'idarti']);
            $table->foreign('idarti')->references('id')->on('articulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresde');
    }
}
