<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Contoh Nama 1',
                'tgl_mulai' => now(),
                'tgl_selesai' => now()->addDays(7),
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 'Contoh Nama 2',
                'tgl_mulai' => now()->addDays(1),
                'tgl_selesai' => now()->addDays(14),
                'status' => false,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ],
        ];

        // ! insert data ke tabel periodiks
        DB::table('periodiks')->insert($data);
    }
}
