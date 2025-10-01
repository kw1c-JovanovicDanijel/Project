<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $is_completed = fake()->boolean();

        return [
            'customer_id' => Customer::factory()->has(Address::factory(rand(1, 3))),
            'order_date' => $is_completed ? fake()->date('d-m-Y') : null,
            'status' => $is_completed ? OrderStatus::VERZONDEN : OrderStatus::BEZIG,
        ];
    }
}
