<?php

namespace Database\Factories;

use App\Models\Signal;
use Illuminate\Database\Eloquent\Factories\Factory;

class SignalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Signal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'macd_value' => $this->faker->randomFloat(2, 0, 1),
            'macd_signal' => $this->faker->randomFloat(2, 0, 1),
            'macd_hist' => $this->faker->randomFloat(2, 0, 1),
            'macd_crossover' => $this->faker->numberBetween(0, 1),
            'rsi_value' => $this->faker->numberBetween(0, 100),
            'stoch_k' => $this->faker->randomFloat(2, 0, 1),
            'stoch_d' => $this->faker->randomFloat(2, 0, 1),
            'market_price' => $this->faker->randomFloat(2, 0, 1),
            'coin_name' => $this->faker->word,
            'via' => $this->faker->word
        ];
    }
}
