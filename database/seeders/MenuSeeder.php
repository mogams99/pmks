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
                'url' => null,
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
                'url' => null,
                'order' => 3,
                'status' => true,
                'active' => 'transaksi',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'User',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => 'user.index', // Kolom url diisi dengan null
                'order' => 1,
                'status' => true,
                'active' => 'user',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'Roles',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => 'roles.index', // Kolom url diisi dengan null
                'order' => 2,
                'status' => true,
                'active' => 'roles',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
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
            [
                'id' => 7,
                'name' => 'Bidang',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => 'bidang.index', // Kolom url diisi dengan null
                'order' => 4,
                'status' => true,
                'active' => 'bidang',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'name' => 'Layanan',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => 'layanan.index', // Kolom url diisi dengan null
                'order' => 5,
                'status' => true,
                'active' => 'layanan',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 9,
                'name' => 'Tipe Jawaban',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => 'tipe_jawaban.index', // Kolom url diisi dengan null
                'order' => 6,
                'status' => true,
                'active' => 'tipe_jawaban',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 10,
                'name' => 'Periodik',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => 'periodik.index', // Kolom url diisi dengan null
                'order' => 7,
                'status' => true,
                'active' => 'periodik',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 11,
                'name' => 'Pertanyaan',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 2,
                'url' => 'pertanyaan.index', // Kolom url diisi dengan null
                'order' => 8,
                'status' => true,
                'active' => 'pertanyaan',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 12,
                'name' => 'Hasil Jawaban',
                'icon' => null, // Kolom icon diisi dengan null
                'parent_id' => 3,
                'url' => 'hasil_jawaban.index', // Kolom url diisi dengan null
                'order' => 1,
                'status' => true,
                'active' => 'Hasil_Jawaban',
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
        ];

        Menu::insert($data);
    }
}
