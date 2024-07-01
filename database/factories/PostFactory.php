<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
    public function definition(): array
    {
        return [
            'author' => fake()->firstName,
            'title' => fake()->words(rand(2, 5), true),
            'content' => fake()->paragraphs(rand(10, 75), true),
            'image' => '668172ba4598e_37649.jpg',
        ];
    }
}