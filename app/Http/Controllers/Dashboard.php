<?php

namespace App\Http\Controllers;

class Dashboard extends Controller
{
    public function main()
    {
        $indodax = indodax();

        $openOrders = $indodax->openOrders();

        return view('asset')->with('orders', $openOrders);
    }
}
