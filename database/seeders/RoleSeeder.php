<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'name' => 'Developer',
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Super Admin',
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
        ];

        Role::insert($data);
    }
}
