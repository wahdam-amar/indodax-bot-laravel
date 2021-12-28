<?php

namespace App\Signals;

use Closure;
use App\Models\Signal;
use Illuminate\Support\Collection;

class Rsi
{
    public function buy(Collection $indicators, Closure $next)
    {
        $rsiValue = Signal::latest('id')->first()->rsi_value;

        if ($rsiValue >= 30) {
            return $next($indicators);
        }

        return collect(
            [
                'should_buy' => true,
                'via' => 'RSI',
            ]
        );
    }

    public function sell($indicators, Closure $next)
    {
        $rsiValue = Signal::latest('id')->first()->rsi_value;

        if ($rsiValue < 70) {
            return $next($indicators);
        }

        return collect(
            [
                'should_sell' => true,
                'via' => 'RSI',
            ]
        );
    }
}
