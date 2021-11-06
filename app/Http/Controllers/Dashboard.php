<?php

namespace App\Http\Controllers;


use App\Services\Account\LiveAccount;


class Dashboard extends Controller
{
    public function main()
    {
        $account = new LiveAccount(auth()->id());

        $order = $account->putOrder('eth', '500000', '500000');

        if ($order) {
            debug($order);
        } else {
            debug('error');
        }

        $openOrders = indodax()->openOrders();

        return view('asset')->with('orders', $openOrders);
    }
}
