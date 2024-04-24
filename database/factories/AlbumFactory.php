<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        return [
            'user_id' => User::factory(),
            'album_name' => $this->faker->text(60),
            'album_thumb' => $this->faker->image(),
            'description' => $this->faker->text(120),
            'created_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),

        ];
    }
}
