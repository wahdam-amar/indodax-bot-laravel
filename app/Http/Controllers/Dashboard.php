<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Indicators;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function main()
    {
        $openOrders = indodax()->openOrders();

        $users = DB::table('macd')->get();

        debug($users);


        return view('asset')->with('orders', $openOrders);
    }
}
