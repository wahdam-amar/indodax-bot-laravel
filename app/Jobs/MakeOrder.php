<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MakeOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $macd = DB::table('macd')->latest()->take(3)->get();

        $placeOrder = $macd->slice(0, 1)[0]->crossover == 1 && $macd->slice(1, 1)[0]->crossover = 0 && $macd->slice(2, 1)[0]->crossover;

        $hasOrder = indodax(5)->hasOrders('eth');

        $price = indodax(5)->getCoinPrice('eth');

        if ($placeOrder) {
            Order::create([
                'type'  => 'buy',
                'status' => '0',
                'amount' => '500000',
                'target' => $price + ($price * 0.01),
                'coin'  =>  'ETH',
                'user_id'   => 5,
                'price'    => $price,
                'price_buy' => $price,
                'price_sell'    => $price + ($price * 0.01),
                'profit' => '',
                'indodax_id' => ''
            ]);
        }
    }
}
