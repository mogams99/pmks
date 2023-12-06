<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\Pertanyaan;
use App\Models\TipeJawaban;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe_jawabans = TipeJawaban::all();
        $layanans = Layanan::all();
        $pertanyaan = [];

        foreach ($layanans as $layanan) {
            foreach ($tipe_jawabans as $tipe_jawaban) {
                $pertanyaan[] = [
                    'tipe_jawabans_id' => $tipe_jawaban->id,
                    'layanans_id' => $layanan->id,
                    'nama' => 'Pertanyaan '. $tipe_jawaban->nama . ' untuk ' . $layanan->nama,
                    'updated_by' => 1,
                    'created_at' => Carbon::now(),
                ];
            }
        }

        // ! mass insert pertanyaan
        Pertanyaan::insert($pertanyaan);
    }
}
