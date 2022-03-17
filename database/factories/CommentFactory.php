<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Post::all()->random();
        return [
            'post_id' => Post::inRandomOrder()->first() ?? Post::factory(),
            'user_id' => User::inRandomOrder()->first() ?? User::factory(),
            'body'    => $this->faker->text(),
        ];
    }
}
