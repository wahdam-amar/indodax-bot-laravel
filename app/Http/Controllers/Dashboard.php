<?php

namespace App\Http\Controllers;

use App\Jobs\MakeOrder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function main()
    {
        $openOrders = indodax()->openOrders();

        // debug(indodax()->hasOrders('eth'));

        // debug($macd->slice(0, 1)[0]->crossover);

        // debug(indodax()->makeOrder('eth_idr', 55000, 55000)->return->order_id);

        return view('asset')->with('orders', $openOrders);
    }
}
