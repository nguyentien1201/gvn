<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSignalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signals', function (Blueprint $table) {
            $table->id();
            $table->string('code',50);
            $table->integer('price_current');
            $table->tinyInteger('trend');
            $table->tinyInteger('signal');
            $table->integer('price_action');
            $table->integer('price_cumulative_from');
            $table->integer('price_cumulative_to');
            $table->integer('price_stoploss');
            $table->integer('price_target');
            $table->integer('profit');
            $table->string('description', 255);
            $table->datetime('date_action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_signals');
    }
}
