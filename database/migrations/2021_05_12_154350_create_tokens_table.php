<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('website')->nullable()->default(null);
            $table->string('domain')->nullable()->default(null);
            $table->string('consumer_key')->nullable()->default(null);
            $table->string('consumer_secret')->nullable()->default(null);
            $table->string('access_token')->nullable()->default(null);
            $table->string('access_token_secret')->nullable()->default(null);
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
        Schema::dropIfExists('tokens');
    }
}
