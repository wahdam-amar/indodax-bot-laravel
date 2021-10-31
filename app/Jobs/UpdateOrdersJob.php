<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\Indodax;
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

        foreach ($orders as  $order) {
            $price = (new Indodax())->setUser($order->user_id)->getCoinPrice('eth');

            if ($price > $order->price_sell) {
                $order->status = 1;
                $order->updated_at = now();
                $order->save();
            }

            Log::info($order->id . ' success updated');
        }
    }
}
