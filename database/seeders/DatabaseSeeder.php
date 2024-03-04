<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'role' => 'Admin',
            'created_at' => Carbon::now()
        ]);
        Role::create([
            'role' => 'Cashier',
            'created_at' => Carbon::now()
        ]);
        Role::create([
            'role' => 'Customer',
            'created_at' => Carbon::now()
        ]);

        User::factory()->create([
            'username' => 'Adryan',
            'email' => 'adryanowh@gmail.com',
            'password' => Bcrypt('password'),
            'roleId' => 1
        ]);
        User::factory()->create([
            'username' => 'Claire',
            'email' => 'clairecottrill@gmail.com',
            'password' => Bcrypt('password'),
            'roleId' => 2
        ]);

        Category::factory()->create([
            'name' => 'T-Shirt',
            'slug' => 't-shirt',
            'description' => 'T-Shirt'
        ]);
        Category::factory()->create([
            'name' => 'Pants',
            'slug' => 'pants',
            'description' => 'Pants'
        ]);
        Customer::factory()->create([
            'name' => 'Guest',
            'address' => 'None',
            'contact' => 'None',
        ]);
        Supplier::factory(5)->create();
        Product::factory(20)->create();
        Customer::factory(10)->create();
    }
}
