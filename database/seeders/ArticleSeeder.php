<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::all();
        $faker = Faker::create();

        foreach ($users as $user) {
            for ($i = 0; $i < rand(2, 5); $i++) {
                Article::create([
                    'title' => $faker->sentence(3),
                    'content' => $faker->paragraphs(3, true),
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
