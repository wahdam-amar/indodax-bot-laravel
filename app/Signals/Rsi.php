<?php

namespace App\Signals;

use Closure;
use Illuminate\Support\Collection;

class Rsi
{
    public function buy(Collection $indicators, Closure $next)
    {
        $rsiValue = $indicators->firstWhere('id', 'rsi');

        $rsiValue = optional($rsiValue)->result->value;

        if ($rsiValue > 30) {
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
        $rsiValue = $indicators->firstWhere('id', 'rsi');

        $rsiValue = optional($rsiValue)->result->value;

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
