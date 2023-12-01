<?php

namespace Database\Seeders;

use App\Models\TipeJawaban;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeJawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $arrayTipeJawaban = ['text', 'select', 'select2', 'textarea', 'file', 'date', 'radio'];
        $i = 0;

        do {
            $data = [
                'nama' => $arrayTipeJawaban[$i],
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ];

            TipeJawaban::insert($data);

            $i++; // ! Tambahkan ini agar nilai $i terus meningkat
        } while ($i < count($arrayTipeJawaban));
    }
}
