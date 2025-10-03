<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyOrder>
 */
class CompanyOrderFactory extends Factory
{
    public function definition(): array
    {
        $is_completed = fake()->boolean();

        return [
            'order_date' => $is_completed ? fake()->date('Y-m-d') : null,
            'status' => $is_completed ? OrderStatus::VERZONDEN : OrderStatus::BEZIG,
        ];
    }
}