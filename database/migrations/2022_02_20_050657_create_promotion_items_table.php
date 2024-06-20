<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('promotion_id');
            $table->bigInteger('customer_id');
            $table->tinyInteger('status')->nullable()->default(0)->comment('0: reserve, 1: done');
            $table->dateTime('send_time')->nullable()->default(null);
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
        Schema::dropIfExists('promotion_items');
    }
}
