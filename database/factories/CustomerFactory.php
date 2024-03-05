<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array<string, mixed>
     */

    protected static ?string $password;
    public function definition(): array
    {
        return [
            // 'roleId' => 3,
            'name' => fake()->name(),
            'address' => fake()->address(),
            'contact' => fake()->phoneNumber(),
            // 'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => static::$password ??= Hash::make('password'),
            // 'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
