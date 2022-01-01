<?php

namespace Database\Factories\Backtest;

use App\Models\Backtest\BacktestBalance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BacktestBalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BacktestBalance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->for(User::class),
            'amount' => $this->faker->randomDigitNotZero() * 100000,
        ];
    }
}
