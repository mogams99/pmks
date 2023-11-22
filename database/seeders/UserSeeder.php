<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
        $data = [
            [
                'roles_id' => 1,
                'username' => 'egov',
                'email' => 'egov@surabaya.go.id',
                'password' => bcrypt('!*2023pmks'),
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ]
        ];

        User::insert($data);
    }
}
