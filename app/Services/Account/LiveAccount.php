<?php

namespace App\Services\Account;

use App\Services\Indodax;
use App\Interfaces\OrderInterface;
use App\Models\User;

class LiveAccount implements OrderInterface
{
    private $app;

    public function __construct(User $user)
    {
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

    public function putOrder()
    {
        // Todo: make order

    }

    public function cancelOrder($pair, $order_id, $type = 'buy')
    {
        return $this->app->cancelOrder($pair, $order_id, $type);
    }
}
