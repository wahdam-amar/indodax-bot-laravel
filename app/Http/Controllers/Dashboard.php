<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateOrdersJob;

class Dashboard extends Controller
{
    public function main()
    {
        $indodax = indodax();

        $openOrders = $indodax->openOrders();

        return view('asset')->with('orders', $openOrders);
    }
}
