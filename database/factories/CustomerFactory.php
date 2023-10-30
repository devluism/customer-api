<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni' => fake()->unique()->numerify('########'),
            'region_id' => fake()->numberBetween(1, Region::count()),
            'commune_id' => fake()->numberBetween(1, Commune::count()),
            'email' => fake()->unique()->safeEmail(),
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'address' => fake()->address(),
        ];
    }
}
