<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Jobs\MakeOrder;
use App\Services\Indodax;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function main()
    {
        $openOrders = indodax()->openOrders();

        debug(indodax()->getAvailableCoin('ada'));


        return view('asset')->with('orders', $openOrders);
    }
}
