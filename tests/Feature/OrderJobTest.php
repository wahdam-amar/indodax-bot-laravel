<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Signal;
use App\Jobs\MakeOrder;
use App\Jobs\UpdateOrdersJob;
use App\Models\Backtest\Backtest;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\assertTrue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderJobTest extends TestCase
{

    use RefreshDatabase;

    public function test_make_order_job()
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
            'status' => 'P',
        ]);
    }

    public function test_order_get_updated_when_price_meet()
    {
        $this->test_make_order_job();

        Signal::factory()->create([
            'rsi_value' => 71,
            'market_price' => 5000000
        ]);

        $backtest_before = Backtest::latest('id')->first();

        // decrease price buy by 1.5
        $priceBuy = $backtest_before->price_buy - ($backtest_before->price_buy * 1.5) / 100;

        $backtest_before->price_buy =  $priceBuy;

        $backtest_before->save();

        $this->assertEquals('P', $backtest_before->status, 'Status should be P');

        $job = new UpdateOrdersJob;

        $job->handle();

        $backtest_after = Backtest::latest('id')->first();

        $this->assertEquals('S', $backtest_after->status, 'Status should be S');

        $this->assertTrue($backtest_before->id == $backtest_after->id, 'Backtest id should be the same');
    }
}
