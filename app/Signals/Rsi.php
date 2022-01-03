<?php

namespace App\Signals;

use Closure;
use App\Models\Signal;
use App\Services\Indodax;
use Illuminate\Support\Collection;

class Rsi
{
    public function buy(Collection $indicators, Closure $next)
    {
        $rsiValue = Signal::latest('id')->first()->rsi_value;

        if ($rsiValue >= 20) {
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
