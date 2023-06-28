<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'title' => $this->faker->name(),
          'description' => $this->faker->sentence(),
          'category_id' => function () {
            return Category::inRandomOrder()->first()->id;
          },
          'user_id' => function () {
            return User::factory()->create()->id;
          },
        ];
    }
}
