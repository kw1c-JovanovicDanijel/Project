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
        // Maak eerst een customer met 1-3 adressen
        $customer = Customer::factory()
            ->has(Address::factory(rand(1, 3)))
            ->create();

        // Pak een willekeurig adres van die customer
        $address = $customer->addresses()->inRandomOrder()->first();

        return [
            'customer_id' => $customer->id,
            'address_id' => $address->id,
            'status' => OrderStatus::BEZIG,
        ];
    }
}
