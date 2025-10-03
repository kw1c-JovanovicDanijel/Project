<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\CompanyOrder;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Account Manager',
            'email' => 'account_manager@admin.com',
            'password' => Hash::make('admin'),
            'role' => UserRoles::ACCOUNT_MANAGER,
        ]);

        User::factory()->create([
            'name' => 'Product Manager',
            'email' => 'product_manager@admin.com',
            'password' => Hash::make('admin'),
            'role' => UserRoles::PRODUCT_MANAGER,
        ]);

        User::factory()->create([
            'name' => 'Backoffice Medewerker',
            'email' => 'backoffice_medewerker@admin.com',
            'password' => Hash::make('admin'),
            'role' => UserRoles::BACKOFFICE_MEDEWERKER,
        ]);

        User::factory()->create([
            'name' => 'Backoffice Manager',
            'email' => 'backoffice_manager@admin.com',
            'password' => Hash::make('admin'),
            'role' => UserRoles::BACKOFFICE_MANAGER,
        ]);

        User::factory()->create([
            'name' => 'Logistiek Manager',
            'email' => 'logistiek_manager@admin.com',
            'password' => Hash::make('admin'),
            'role' => UserRoles::LOGISTIEK_MANAGER,
        ]);

        Supplier::factory(100)->has(
            Address::factory(3))
            ->create();

        $products = Product::factory(200)->create();

        Order::factory(100)->create()->each(function (Order $order) use ($products) {
            $randomProducts = $products->random(rand(1, 5));

            $order->products()->attach(
                $randomProducts->mapWithKeys(fn (Product $product) => [
                    $product->id => [
                        'quantity' => rand(1, 10),
                        'price' => $product->sell_price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ])->toArray()
            );
        });

        // CompanyOrder seeding
        CompanyOrder::factory(50)->create()->each(function (CompanyOrder $order) use ($products) {
            $randomProducts = $products->random(rand(1, 5));
            $order->products()->attach(
                $randomProducts->mapWithKeys(fn ($product) => [
                    $product->id => [
                        'quantity' => rand(1, 10),
                        'price' => $product->buy_price,
                    ]
                ])->toArray()
            );
        });
    }
}
