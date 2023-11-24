<?php

namespace Database\Seeders;

use App\Models\Opd;
use App\Models\Peruntukan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $raw = ['Dinas Perlindungan Perempuan dan Anak', 'Dinas Kesehatan', 'Dinas Sosial', 'Dinas Pendidikan', 'Badan Narkotika Nasional', 'RSJ Menur', 'RS. Soewandhi'];
        $peruntukans = Peruntukan::select('id', 'nama')->get();

        foreach ($peruntukans as $peruntukan) {
            // dd($peruntukan->nama);
            foreach ($raw as $opdName) {
                if (strpos($opdName, $peruntukan->nama) !== false) {
                    Opd::create([
                        'nama' => $opdName,
                        'peruntukans_id' => $peruntukan->id,
                        'created_by' => 1,
                        'created_at' => now(),
                    ]);
                }
            }
        }
    }
}
