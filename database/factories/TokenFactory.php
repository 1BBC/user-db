<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Token>
 */
class TokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->ipv4,
            'used_by' => $this->faker->optional()->ipv4,
            'expired_at' => $this->faker->dateTimeBetween('-1 week', '+1 week')
        ];
    }
}
