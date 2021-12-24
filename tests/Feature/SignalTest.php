<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Signals\Rsi;
use Illuminate\Pipeline\Pipeline;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class SignalTest extends TestCase
{
    /** @test */
    public function signal_buy_with_rsi()
    {
        $indicators = collect([
            0 => (object)[
                'id' => 'rsi',
                'result' => (object) ['value' => 28]
            ]
        ]);

        $pipe = app(Pipeline::class)
            ->send($indicators)
            ->via('buy')
            ->through([
                Rsi::class
            ])
            ->then(function ($indicators) {
                return $indicators;
            });

        assertTrue($pipe->get('should_buy'));
    }

    /** @test */
    public function cant_signal_buy_with_rsi()
    {
        $indicators = collect([
            0 => (object)[
                'id' => 'rsi',
                'result' => (object) ['value' => 31]
            ]
        ]);

        $pipe = app(Pipeline::class)
            ->send($indicators)
            ->via('buy')
            ->through([
                Rsi::class
            ])
            ->then(function ($indicators) {
                return $indicators;
            });

        assertFalse($pipe->get('should_buy', false));
    }

    /** @test */
    public function signal_sell_with_rsi()
    {
        $indicators = collect([
            0 => (object)[
                'id' => 'rsi',
                'result' => (object) ['value' => 70]
            ]
        ]);

        $pipe = app(Pipeline::class)
            ->send($indicators)
            ->via('sell')
            ->through([
                Rsi::class
            ])
            ->then(function ($indicators) {
                return $indicators;
            });

        assertTrue($pipe->get('should_sell'));
    }
}
