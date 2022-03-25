<?php

namespace Database\Seeders;

use App\Models\StatusKeluarga;
use Illuminate\Database\Seeder;

class StatusKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'Kepala Keluarga',
            'Suami',
            'Istri',
            'Anak',
            'Menantu',
            'Cucu',
            'Orang Tua',
            'Mertua',
            'Famili Lain',
            'Pembantu',
            'Lainnya',
        ];

        foreach ($status as $data) :
            StatusKeluarga::firstOrCreate([
                'nama' => $data
            ]);
        endforeach;
    }
}
