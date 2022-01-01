<?php

namespace App\Services\Account;

use App\Models\User;
use App\Models\Backtest\Backtest;
use App\Interfaces\OrderInterface;

class BacktestAccount implements OrderInterface
{
    private User $user;

    public function openOrders()
    {
        return Backtest::where('status', 'P')->get();
    }

    public function hasOrders(string $coin, string $type = 'buy')
    {
        return Backtest::where('status', 'P')
            ->where('pair', $coin)->get();
    }

    public function sucessfulOrders()
    {
        return Backtest::where('status', 'S')->get();
    }

    public function putOrder(string $coin, float $price, float $amount, string $type = 'buy')
    {
        $pendingOrder = $this->hasOrders($coin, $type);

        if (!$pendingOrder->isEmpty()) {
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

        $priceCondition = getCalculatePercentageChange($backtest->price_buy, $price_sell) >= 1.5;

        if (!$priceCondition) {
            return;
        }

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
        /**
         * @var User $this->user
         */
        $this->user = $user;

        $this->user->load('setting');

        return $this;
    }
}
