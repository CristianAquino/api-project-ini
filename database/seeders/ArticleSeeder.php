<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::all();
        $categories = Category::all();

        foreach ($users as $user) {
            Article::factory(rand(2, 5))
                ->create([
                    'user_id' => $user->id,
                    'category_id' => $categories->random()->id
                ]);
        }
    }
}
