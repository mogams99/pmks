<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $raw = ['Bidang 1', 'Bidang 2', 'Bidang 3'];
        $i = 0;

        do {
            $data = [
                'nama' => $raw[$i],
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ];

            Bidang::insert($data);

            $i++; // Tambahkan ini agar nilai $i terus meningkat
        } while ($i < count($raw));
    }
}
