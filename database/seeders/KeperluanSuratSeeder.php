<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use App\Models\KeperluanSurat;
use Illuminate\Database\Seeder;

class KeperluanSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keperluan_surats = [
            'Perpanjangan KTP / KK / KIPEM',
            'Surat Keterangan Kelakuan Baik',
        	'Surat Pengantar Nikah',
            'Surat Keterangan Tidak Mampu',
        ];

        foreach ($keperluan_surats as $keperluan_surat) :
            KeperluanSurat::firstOrCreate([
                'nama' => $keperluan_surat
            ]);
        endforeach;
    }
}
