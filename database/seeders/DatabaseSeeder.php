<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
        User::factory()->create([
            'username' => 'Guest',
            'email' => 'customer@gmail.com',
            'password' => Bcrypt('password'),
            'roleId' => 3
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
        Supplier::factory()->create([
            'name' => '7Club',
            'slug' => '7club'
        ]);
    }
}
