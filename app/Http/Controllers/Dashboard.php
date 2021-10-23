<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Indicators;

class Dashboard extends Controller
{
    public function main()
    {
        $openOrders = indodax()->openOrders();
        $indicators = (new Indicators)->get();

        return view('asset')->with('orders', $openOrders);
    }
}
