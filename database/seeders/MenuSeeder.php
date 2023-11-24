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
                'parent_id' => null,
                'url' => 'dashboard.index',
                'order' => 1,
                'status' => true,
                'active' => 'dashboard',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Master',
                'icon' => 'bi bi-database-check',
                'parent_id' => null,
                'url' => '1',
                'order' => 2,
                'status' => true,
                'active' => 'master',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Transaksi',
                'icon' => 'bi bi-list-check',
                'parent_id' => null,
                'url' => '2',
                'order' => 3,
                'status' => true,
                'active' => 'transaksi',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Manajemen User',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => '3', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'active' => 'manajemen_user',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'User',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 4,
                'url' => '4', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'active' => 'user',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => 'Role',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 4,
                'url' => '5', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'active' => 'role',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'name' => 'Akses',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 4,
                'url' => '6', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'active' => 'akses',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'name' => 'OPD',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => 'opd.index', // Kolom url diisi dengan null
                'order' => 3,
                'status' => true,
                'active' => 'opd',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
        ];

        Menu::insert($data);
    }
}
