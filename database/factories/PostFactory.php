<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(3),
            'excerpt' => '<p>'.implode('<p><p>', $this->faker->paragraphs(2)).'</p>',
            'body' => '<p>'.implode('<p><p>', $this->faker->paragraphs(6)).'</p>',
        ];
    }
}
