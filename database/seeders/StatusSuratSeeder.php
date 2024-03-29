<?php

namespace Database\Seeders;

use App\Models\StatusSurat;
use Illuminate\Database\Seeder;

class StatusSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_surats = [
            'Menunggu Tanda Tangan RT',
        	'Selesai',
            'Ditolak',
        ];

        foreach ($status_surats as $status_surat) :
           StatusSurat::firstOrCreate([
                'nama' => $status_surat
            ]);
        endforeach;
    }
}
