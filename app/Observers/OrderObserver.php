<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $coin = Str::lower($order->coin) . '_idr';

        $status = indodax()->setUser($order->user_id)->makeOrder($coin, $order->price_buy, $order->amount);

        if ($status->success = 1) {
            $order->indodax_id = $status->return->order_id;
            $order->save();
        }

        Log::info('Order created event ' . $order->id . ' is created');
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        if (!$order->status == 1) {
            return;
        }
        try {
            $coinName = Str::lower($order->coin) . '_idr';
            $coinAmount = indodax()->setUser($order->user_id)->getAvailableCoin($coinName);
            $price = indodax()->setUser($order->user_id)->getCoinPrice($coinName);

            indodax()->setUser($order->user_id)->makeOrder($coinName, $price, $coinAmount, 'sell');
        } catch (\Throwable $th) {
            Log::error('Error sell ' . $order . ' ' . $th);
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
