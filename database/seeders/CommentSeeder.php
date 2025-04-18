<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


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
        $faker = Faker::create();

        foreach ($articles as $article) {
            for ($i = 0; $i < rand(0, 5); $i++) {
                # code...
                Comment::create([
                    'comment' => $faker->paragraph,
                    'user_id' => $users->random()->id,
                    'article_id' => $article->id,
                ]);
            }
        }
    }
}
