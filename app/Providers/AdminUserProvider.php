<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AdminUserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        if (!User::where('email', 'admin@admin.com')->exists()) {
            // create admin
            $admin = Admin::factory()->create();
            $admin->user()->create([
                'name' => 'administrator',
                'email' => 'admin@admin.com',
                'password' => '12345678',
                'role' => User::ROLE_SUPERADMIN
            ]);
        }
    }
}
