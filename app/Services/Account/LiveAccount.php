<?php

namespace App\Services\Account;

use App\Models\User;
use App\Models\Order;
use App\Services\Indodax;
use App\Interfaces\OrderInterface;

class LiveAccount implements OrderInterface
{
    private $app;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->app = (new Indodax())->setUser($user);
    }

    public function openOrders()
    {
        return $this->app->openOrders();
    }

    public function hasOrders(String $coin, String $type = 'buy')
    {
        return $this->app->hasOrders($coin, $type);
    }

    public function sucessfulOrders()
    {
        // Todo: get all of sucessful orders
    }

    public function putOrder(String $pair, String $price, String $amount, String $type = 'buy')
    {
        if ($this->hasOrders($pair, 'buy') || $this->hasOrders($pair, 'sell')) {
            return;
        }

        sleep(1);

        $order = $this->app->makeOrder($pair, $price, $amount, $type)->return->order_id ?? null;

        if (!$order) {
            return $order;
        }

        Order::create([
            'type'  => $type,
            'status' => '0',
            'amount' => $amount,
            'coin'  =>  $pair,
            'user_id'   => $this->user,
            'price_buy' => $price,
            'price_sell'    => $price + ($price * 0.01),
            'profit' => '',
            'indodax_id' => $order
        ]);

        return $order;
    }


    public function cancelOrder($pair, $order_id, $type = 'buy')
    {
        return $this->app->cancelOrder($pair, $order_id, $type);
    }
}
