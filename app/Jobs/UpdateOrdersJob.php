<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\Indodax;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateOrdersJob implements ShouldQueue
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
        $orders = Order::where('status', 0)->get();

        if (!$orders) {
            return;
        }

        foreach ($orders as  $order) {
            $price = (new Indodax())->setUser($order->user_id)->getCoinPrice('eth');

            Log::info($order->id . ' with price : ' . $order->price_sell . ', price eth now : ' . $price);

            if ($price > $order->price_sell) {

                $order->status = 1;
                $order->updated_at = now();
                $order->save();

                try {
                    $coinName = Str::lower($order->coin);
                    $coinAmount = indodax()->setUser($order->user_id)->getAvailableCoin($coinName);
                    $price = indodax()->setUser($order->user_id)->getCoinPrice($coinName);

                    indodax()->setUser($order->user_id)->makeOrder($coinName, $price, $coinAmount, 'sell');
                } catch (\Throwable $th) {
                    Log::error('Error sell ' . $order . ' ' . $th);
                }

                Log::info($order->id . ' success updated');
            }
        }
    }
}
