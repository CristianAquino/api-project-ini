<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = Category::all();

        User::factory(10)
            ->create()
            ->each(function ($user) use ($categories) {
                $categories_id = fake()->randomElements($categories, fake()->numberBetween(1, 3));
                $user->categories()->attach($categories_id);
            });
    }
}
