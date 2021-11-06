<?php

namespace App\Interfaces;

interface OrderInterface
{
    public function openOrders();
    public function hasOrders(String $coin, String $type = 'buy');
    public function sucessfulOrders();
    public function putOrder();
    public function cancelOrder($pair, $order_id, $type = 'buy');
}
