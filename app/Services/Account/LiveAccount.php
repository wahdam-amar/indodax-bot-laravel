<?php

namespace App\Services\Account;

use App\Services\Indodax;
use App\Interfaces\OrderInterface;

class LiveAccount implements OrderInterface
{
    private $app;

    public function __construct()
    {
        $this->app = new Indodax;
    }

    public function openOrders()
    {
        return $this->app->openOrders();
    }

    public function sucessfulOrders()
    {
        // Todo: get all of sucessful orders
    }

    public function putOrder()
    {
        // Todo: put order
    }

    public function cancelOrder($orderId)
    {
        // Todo: cancel order
    }
}
