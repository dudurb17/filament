<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $usersId= DB::table('users')->pluck('id');
        return [
            'userId'=>fake()->randomElement($usersId),
            'name' => fake()->name(),
            'street'=>fake()->lastName(),
            'number'=>fake()->numberBetween(1, 999),
            'neighborhood'=>fake()->name()
        ];
    }
}
