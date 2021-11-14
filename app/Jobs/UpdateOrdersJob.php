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

        if ($orders->isEmpty()) {
            return;
        }

        Log::info('Found ' . $orders->count() . ' orders to update');

        foreach ($orders as  $order) {

            Log::info('Updating order ' . $order->id);

            $indodax = (new Indodax())->setUser($order->user_id);

            $price = $indodax->getCoinPrice($order->coin);

            if ($price > $order->price_sell) {

                $order->status = 1;
                $order->updated_at = now();
                $order->save();

                try {
                    $coinName = Str::lower($order->coin);

                    $coinAmount = $indodax->getAvailableCoin($coinName);

                    $price = $indodax->getCoinPrice($coinName);

                    $result = $indodax->makeOrder($coinName, $price, $coinAmount, 'sell');

                    Log::info('Result UpdateOrdersJob' . $result->success . ' ' . $result->error);
                } catch (\Throwable $th) {
                    Log::error('Error sell ' . $th->getMessage());
                }
            }
        }
    }
}
