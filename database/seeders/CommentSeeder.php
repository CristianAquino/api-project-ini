<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::all();
        $articles = Article::all();

        for ($i = 0; $i < count($articles); $i++) {
            # code...
            $article = fake()->randomElements($articles, 1, true);
            Comment::factory(rand(1, 3))
                ->create([
                    'user_id' => $users->random()->id,
                    'article_id' => $article[0]->id
                ]);
        }
    }
}
