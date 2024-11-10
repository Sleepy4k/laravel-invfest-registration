<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            [
                'name' => 'team',
                'guard_name' => 'web'
            ],
            [
                'name' => 'petugas',
                'guard_name' => 'web'
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ]
        ];
    }
}
