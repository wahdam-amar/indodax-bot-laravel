<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Signal;
use App\Jobs\MakeOrder;
use App\Models\Backtest;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\assertTrue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderJobTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function make_order_job_test()
    {
        $user = User::factory()->create();

        $user->api()->create([
            'user_id' => $user->id,
            'api_key' => '123',
            'secret_key' => '123',
        ]);

        Signal::factory()->create([
            'rsi_value' => 29,
            'market_price' => 5000000
        ]);

        $job = new MakeOrder;
        $job->handle();

        $this->assertDatabaseHas('backtests', [
            'user_id' => $user->id,
            'amount' => 5000000,
        ]);
    }
}
