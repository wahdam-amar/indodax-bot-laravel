<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Signal;
use App\Services\Indodax;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderJobTest extends TestCase
{
    /** @test */
    public function make_order_job_test()
    {

        $indodax = new Indodax;
        $price =  $indodax->getCoinPrice('eth');

        $signal = new Signal;
        $signal->macd_value = 1;
        $signal->macd_signal = 1;
        $signal->macd_hist = 1;
        $signal->macd_crossover = 1;
        $signal->rsi_value = 29;
        $signal->stoch_k = null;
        $signal->stoch_d = null;
        $signal->market_price = $price;
        $signal->coin_name = 'ETH/USDT';
        $signal->via = 'binance';
        $signal->save();

        dispatch(new \App\Jobs\MakeOrder);

        $this->assertDatabaseHas('backtests', [
            'price_buy' => $price
        ]);
    }
}
