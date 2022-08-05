<?php

namespace Database\Seeders;

use App\Models\StatusWarga;
use Illuminate\Database\Seeder;

class StatusWargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'Warga',
            'Pindah',
            'Meninggal'
        ];

        foreach ($status as $data) :
            StatusWarga::firstOrCreate([
                'nama' => $data
            ]);
        endforeach;
    }
}
