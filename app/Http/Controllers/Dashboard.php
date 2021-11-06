<?php

namespace App\Http\Controllers;


use App\Services\Account\LiveAccount;


class Dashboard extends Controller
{
    public function main()
    {
        $openOrders = indodax()->openOrders();

        return view('asset')->with('orders', $openOrders);
    }
}
