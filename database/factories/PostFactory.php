<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends Factory<Post>
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
        $title = fake()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(3, true),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ,
            'user_id' => User::factory(),
            'image' => fake()->imageUrl(),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),

        ];
    }
}
