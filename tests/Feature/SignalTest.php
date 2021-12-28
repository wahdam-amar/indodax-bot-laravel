<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Signals\Rsi;
use App\Models\Signal;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertTrue;

use function PHPUnit\Framework\assertFalse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SignalTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function signal_buy_with_rsi()
    {

        Signal::factory()->create([
            'rsi_value' => 29
        ]);

        $indicators = collect();

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

        Signal::factory()->create([
            'rsi_value' => 70,
        ]);

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

        Signal::factory()->create([
            'rsi_value' => 70,
        ]);

        $indicators = collect();

        $pipe = app(Pipeline::class)
            ->send($indicators)
            ->via('sell')
            ->through([
                Rsi::class
            ])
            ->then(function ($indicators) {
                return $indicators;
            });

        assertTrue($pipe->get('should_sell', false));
    }
}
