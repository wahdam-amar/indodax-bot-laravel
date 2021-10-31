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

        return view('asset')->with('orders', $openOrders);
    }
}
