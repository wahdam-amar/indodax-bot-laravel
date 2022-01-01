<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserSetting;
use App\Models\Backtest\BacktestBalance;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BacktestTest extends TestCase
{
    use RefreshDatabase;

    public function testUserHaveSetting()
    {
        $user = User::factory()
            ->has(UserSetting::factory()->count(1), 'setting')
            ->create();

        $this->assertDatabaseHas('user_settings', [
            'user_id' => $user->id
        ]);
    }

    public function testUserHaveBacktestBalance()
    {
        $user = User::factory()->has(BacktestBalance::factory()->count(1), 'backtestBalance')->create();

        logger($user->backtestBalance);

        $this->assertDatabaseHas('backtest_balances', [
            'user_id' => $user->id
        ]);
    }
}
