<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBacktestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backtests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('pair');
            $table->string('amount');
            $table->string('time_buy');
            $table->string('price_buy');
            $table->string('price_sell')->nullable();
            $table->string('time_sell')->nullable();
            $table->string('profit')->nullable();
            $table->string('status');
            $table->string('via');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('backtests');
    }
}
