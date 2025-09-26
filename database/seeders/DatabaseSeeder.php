<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Address::factory(100)->create();
        //        Customer::factory(100)
        //            ->has(Address::factory(rand(1, 3)))
        //            ->create();
        //        Supplier::factory(100)
        //            ->has(Address::factory(rand(1, 3)))
        //            ->create();
    }
}
