<?php

namespace Database\Seeders;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Dashboard',
                'icon' => 'fonticon-house',
                'url' => 'dashboard.index',
                'order' => 1,
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Master',
                'icon' => 'bi bi-database-check',
                'url' => '1',
                'order' => 2,
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Transaksi',
                'icon' => 'bi bi-list-check',
                'url' => '2',
                'order' => 3,
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Manajemen User',
                'icon' => null, // Kolom icon diisi dengan null
                'url' => '3', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'User',
                'icon' => null, // Kolom icon diisi dengan null
                'url' => '4', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => 'Role',
                'icon' => null, // Kolom icon diisi dengan null
                'url' => '5', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'name' => 'Role',
                'icon' => null, // Kolom icon diisi dengan null
                'url' => '6', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'name' => 'Test',
                'icon' => null, // Kolom icon diisi dengan null
                'url' => '7', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
        ];

        Menu::insert($data);
    }
}