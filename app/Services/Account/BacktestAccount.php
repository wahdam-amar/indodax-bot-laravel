<?php

namespace App\Services\Account;

use App\Models\User;
use App\Models\Backtest;
use App\Interfaces\OrderInterface;
use Illuminate\Database\Eloquent\Builder;

class BacktestAccount implements OrderInterface
{
    private User $user;

    public function openOrders(): Builder
    {
        return Backtest::where('status', 'P');
    }

    public function hasOrders(string $coin, string $type = 'buy'): Builder
    {
        return Backtest::where('status', 'P')
            ->where('coin', $coin);
    }

    public function sucessfulOrders(): Builder
    {
        return Backtest::where('status', 'S');
    }

    public function putOrder(string $coin, string $price, string $amount, string $type = 'buy')
    {

        $pendingOrder = $this->hasOrders($coin, $type);

        if ($pendingOrder->exists()) {
            return;
        }

        $backtest = new Backtest();
        $backtest->user_id = $this->user->id;
        $backtest->pair = $coin;
        $backtest->amount = $amount;
        $backtest->time_buy = now();
        $backtest->price_buy = $price;
        $backtest->status = 'P';
        $backtest->via = 'backtest';
        $backtest->save();

        return $backtest;
    }

    public function cancelOrder($pair, $order_id, $type = 'buy'): Backtest
    {
        $backtest = Backtest::find($order_id);
        $backtest->status = 'C';
        $backtest->save();

        return $backtest;
    }

    public function updateOrder(Backtest $backtest, $price_sell)
    {
        $backtest->status = 'S';
        $backtest->time_sell = now();
        $backtest->price_sell = $price_sell;
        $backtest->save();
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}
