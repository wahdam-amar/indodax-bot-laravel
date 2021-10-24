<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Indicators;

class Dashboard extends Controller
{
    public function main()
    {
        $openOrders = indodax()->openOrders();

        // $eth = indodax()->getCoinPrice('eth');
        // $createOrder = indodax()->makeOrder('eth_idr', $eth, 50000);

        return view('asset')->with('orders', $openOrders);
    }
}
