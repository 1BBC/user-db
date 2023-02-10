<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'  => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->regexify('^[\+]{0,1}380\d{9}$'),
            'photo' => $this->faker->blankImage(Storage::path(User::PHOTO_PATH)),
            'position_id' => Position::query()->inRandomOrder()->take(1)->value('id'),
        ];
    }
}
