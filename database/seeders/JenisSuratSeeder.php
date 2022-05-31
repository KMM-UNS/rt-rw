<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_surats = [
            'Surat Pengantar',
            'Surat Keterangan'
        ];

        foreach ($jenis_surats as $jenis_surat) :
            JenisSurat::firstOrCreate([
                'nama' => $jenis_surat
            ]);
        endforeach;
    }
}
