<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_name' => $this->faker->word(),
            'car_type_id' => rand(1, 10), // pastikan car_types ada ID 1-10
            'car_image' => $this->faker->imageUrl(640, 480, 'cars', true),
            'police_number' => 'AB ' . strtoupper($this->faker->bothify('??###')),
            'year' => $this->faker->year(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
