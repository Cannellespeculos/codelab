<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Basket>
 */
class BasketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nbrproducts" => fake() -> biasedNumberBetween(0, 1000),
            "user_id" =>  fake() ->biasedNumberBetween(0, 10)
        ];
    }
}
