<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(3)->create();
        $categories = Category::factory(10)->create();

        Post::factory(50)->create(fn() => [
            'user_id' => $users->random(),
            'category_id' => $categories->random(),
        ]);
    }
}
