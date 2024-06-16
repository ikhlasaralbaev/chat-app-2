<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        $user = User::create(
            [
                'name' => "Ikhlas Aralbaev",
                'email' => "admin@gmail.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => "123123123",
                'role' => "admin",
                "avatar" => fake()->image()
            ]
            );

        Role::create(["name" => "admin", "guard_name" => "web"]);
        Role::create(["name" => "user", "guard_name" => "web"]);

        $role = Role::findByName("admin");
        $user->assignRole($role);

    }
}