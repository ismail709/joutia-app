<?php

namespace Database\Factories;

use App\Enums\AdStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraphs(5,true),
            'price' => fake()->numberBetween(100,100000),
            'city' => fake()->city(),
            'address' => fake()->streetAddress(),
            'status' => fake()->randomElement([AdStatusEnum::APPROVED,AdStatusEnum::REFUSED,AdStatusEnum::PENDING])
        ];
    }
}
