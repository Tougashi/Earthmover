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
            'role' => 'Kasir',
            'created_at' => Carbon::now()
        ]);
        Role::create([
            'role' => 'Pelanggan',
            'created_at' => Carbon::now()
        ]);

        User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'roleId' => 1
        ]);
        User::factory()->create([
            'username' => 'Kasir',
            'email' => 'kasir@example.com',
            'password' => Hash::make('password'),
            'roleId' => 2
        ]);
        User::factory()->create([
            'username' => 'Pelanggan',
            'email' => 'pelanggan@example.com',
            'password' => Hash::make('password'),
            'roleId' => 3
        ]);

        Category::factory()->create([
            'name' => 'Makanan',
            'description' => 'Makanan Berat & Ringan'
        ]);
        Category::factory()->create([
            'name' => 'Minuman',
            'description' => 'Minuman Berat & Ringan'
        ]);
    }
}
