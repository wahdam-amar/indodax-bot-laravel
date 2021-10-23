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

        debug($indicators);

        return view('asset')->with('orders', $openOrders);
    }
}
