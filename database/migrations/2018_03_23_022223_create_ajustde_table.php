<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAjustdeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajustde', function (Blueprint $table) {
            $table->integer('idajen')->unsigned();
            $table->integer('idbod')->required();
            $table->integer('idarti')->unsigned();
            $table->integer('cantidad')->required();
            $table->decimal('vcosto',11,2)->required();
            $table->decimal('vneto',11,2)->required();
            $table->decimal('piva',11,2)->required();
            $table->decimal('vtotal',11,2)->required();
            $table->timestamps();
        });
        
        //Schema::disableForeignKeyConstraints();
        Schema::table('ajustde', function (Blueprint $table) {
            $table->index('idajen');
            $table->index('idarti');
            $table->index(['idbod', 'idarti']);
            $table->foreign('idajusten')->references('id')->on('ajusten');
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
        Schema::dropIfExists('ajustde');
    }
}
