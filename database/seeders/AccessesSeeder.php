<?php

namespace Database\Seeders;

use App\Models\Access;
use App\Models\Menu;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $role = Role::where('id', 1)->first();
        $menus = Menu::all();
        $data = [];
        foreach ($menus as $key => $value) {
            $data = [
                'menus_id' => $value->id,
                'roles_id' => $role->id,
                'select' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ];

            Access::insert($data);
        }
    }
}
