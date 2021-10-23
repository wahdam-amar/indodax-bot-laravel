<?php

namespace App\Interfaces;

interface OrderInterface
{
    public function openOrders();
    public function sucessfulOrders();
    public function putOrder();
    public function cancelOrder($orderId);
}
