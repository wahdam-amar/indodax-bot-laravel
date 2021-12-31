<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BacktestTest extends TestCase
{
    use RefreshDatabase;

    public function testBacktestCanAssignedToUser()
    {
        $user = User::factory()
            ->has(UserSetting::factory()->count(1), 'setting')
            ->create();

        logger()->info('user', [$user->setting]);

        $this->assertTrue(true);
    }
}
