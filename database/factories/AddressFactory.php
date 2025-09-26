<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isCustomer = fake()->boolean(50);

        return [
            'house_number' => rand(1, 80).fake()->randomElement([null, 'a', 'b', 'c']),
            'street_name' => fake()->streetName(),
            'zip_code' => fake()->postcode(),
            'city' => fake()->city(),
            'addressable_id' => $isCustomer
                                    ? Customer::factory()
                                    : Supplier::factory(),
            'addressable_type' => $isCustomer
            ? Customer::class
            : Supplier::class,

        ];
    }
}
