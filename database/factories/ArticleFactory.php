<?php

namespace Database\Factories;

use App\Enums\ArticleSource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->words(5, true),
            'body' => fake()->paragraphs(10, true),
            'category' => implode(fake()->randomElements(['consciousness', 'love-wisdom-health', 'group dynamics', 'money', 'politics & geopolitics'])),
            'slug' => fake()->sentence(1) . '-' . fake()->sentence(1),
            'source' => ArticleSource::App,
            'user_id' => User::pluck('id')->first(),
        ];
    }
}
