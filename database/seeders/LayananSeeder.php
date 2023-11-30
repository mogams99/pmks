<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayLayanan = ['Layanan 1', 'Layanan 2', 'Layanan 3'];
        $bidangs = Bidang::select('id', 'nama')->first();
        $i = 0;

        do {
            $data = [
                'bidangs_id' => $bidangs->id,
                'nama' => $arrayLayanan[$i],
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ];

            Layanan::insert($data);

            $i++; // ! Tambahkan ini agar nilai $i terus meningkat
        } while ($i < count($arrayLayanan));
    }
}
