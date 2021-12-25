<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignalsTable extends Migration
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
            $table->string('macd_value');
            $table->string('macd_signal');
            $table->string('macd_hist');
            $table->boolean('macd_crossover');
            $table->string('rsi_value');
            $table->string('stoch_k')->nullable();
            $table->string('stoch_d')->nullable();
            $table->string('market_price');
            $table->string('coin_name');
            $table->string('via')->nullable();
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
        Schema::dropIfExists('signals');
    }
}
