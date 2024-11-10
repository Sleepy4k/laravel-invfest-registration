<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competition>
 */
class CompetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(rand(3, 6)),
            'description' => fake()->words(rand(10, 20), true),
            'poster' => null,
            'guidebook' => null,
            'registration_fee' => rand(1000000, 10000000),
            'whatsapp_group' => null,
        ];
    }
}
