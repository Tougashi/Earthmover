<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
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
            'role' => 'Customers',
            'created_at' => Carbon::now()
        ]);

        User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Bcrypt('password'),
            'roleId' => 1
        ]);
        User::factory()->create([
            'username' => 'Cashier',
            'email' => 'cashier@example.com',
            'password' => Bcrypt('password'),
            'roleId' => 2
        ]);
        User::factory()->create([
            'username' => 'Customers',
            'email' => 'customers@example.com',
            'password' => Bcrypt('password'),
            'roleId' => 3
        ]);

        Category::factory()->create([
            'name' => 'T-Shirt',
            'description' => 'T-Shirt'
        ]);
        Category::factory()->create([
            'name' => 'Pants',
            'description' => 'Pants'
        ]);
    }
}
