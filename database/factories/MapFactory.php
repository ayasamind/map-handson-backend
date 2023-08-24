<?php

namespace Database\Factories;

use App\Enums\ZoomLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->streetName(),
            'description' => fake()->realText(),
            'center_lat' => fake()->latitude(),
            'center_lon' => fake()->longitude(),
            'zoom_level' => ZoomLevel::DEFAULT,
        ];
    }
}
