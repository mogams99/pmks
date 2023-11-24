<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // ? merefresh (mengatur ulang) ID untuk tabel users
        DB::statement('TRUNCATE TABLE roles, users, menus, role_user, accesses, peruntukans, opds RESTART IDENTITY CASCADE');

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(AccessesSeeder::class);
        $this->call(PeruntukanSeeder::class);
        $this->call(OpdSeeder::class);
    }
}
