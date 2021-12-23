<?php

namespace App\Http\Controllers;

use App\Signals\Rsi;
use Illuminate\Pipeline\Pipeline;

class Dashboard extends Controller
{
    public function main()
    {

        $indicators = indicator()
            ->symbol('ETH/USDT')
            ->interval('15m')->get();

        $pipe = app(Pipeline::class)
            ->send($indicators)
            ->via('buy')
            ->through([
                Rsi::class
            ])
            ->then(function ($indicators) {
                return $indicators;
            });

        debug(collect([
            'indicators' => 'all',
        ]));


        if ($pipe->get('should_buy')) {
            debug($pipe->get('via'));
        }

        return view('asset');
    }
}
