<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Pest\Laravel\get;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->word(),
            'description' => fake()->text(),
            'buy_price' => fake()->numberBetween(1, 5),
            'sell_price' => fake()->numberBetween(10, 50),
            'supplier_id' => Supplier::factory(),
        ];

    }
}
