<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),              // e.g., "Jane Doe"
            'bio' => $this->faker->paragraph(),          // e.g., "Jane is a novelist..."
            'nationality' => $this->faker->country(),    // e.g., "Cambodia"
        ];
    }
}
