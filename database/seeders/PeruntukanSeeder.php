<?php

namespace Database\Seeders;

use App\Models\Peruntukan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeruntukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $raw = ['Dinas', 'Badan', 'Bagian', 'RS'];
        $i = 0;

        do {
            $data = [
                'nama' => $raw[$i],
                'status' => true,
                'created_by' => 1,
                'created_at' => Carbon::now(),
            ];

            Peruntukan::insert($data);

            $i++; // Tambahkan ini agar nilai $i terus meningkat
        } while ($i < count($raw));
    }
}
