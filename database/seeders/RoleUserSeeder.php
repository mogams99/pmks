<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
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
                'users_id' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
        ];

        DB::table('role_user')->insert($data);
    }
}
