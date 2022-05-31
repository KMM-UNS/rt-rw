<?php

namespace Database\Seeders;

use App\Models\JenisSuratKeterangan;
use Illuminate\Database\Seeder;

class JenisSuratKeteranganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis_surats = [
            'Surat Keterangan Domisili',
            'Surat Keterangan Usaha',
            'Surat Keterangan Tidak Mampu',
            'Surat Keterangan Belum Menikah',
            'Surat Keterangan Kehilangan',
        ];

        foreach ($jenis_surats as $jenis_surat) :
            JenisSuratKeterangan::firstOrCreate([
                'nama' => $jenis_surat
            ]);
        endforeach;
    }
}
