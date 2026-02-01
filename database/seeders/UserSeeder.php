<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use App\Models\Writer;
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
                if ($user->role == User::ROLE_ADMIN) {
                    $poly = Admin::factory()->create();
                } else {
                    $poly = Writer::factory()->create();
                }
                $user->userable()->associate($poly)->save();
                $categories_id = fake()->randomElements($categories, fake()->numberBetween(1, 3));
                $user->categories()->attach($categories_id);
            });
    }
}
