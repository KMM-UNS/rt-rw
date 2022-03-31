<?php

namespace Database\Seeders;

use App\Models\StatusHunian;
use Illuminate\Database\Seeder;

class StatusHunianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'Pribadi/Keluarga',
            'Kontrakan/Sewa',
            'Rumah Panti',
            'Rumah Kost',
            'Rumah Kosong',
        ];

        foreach ($status as $data) :
            StatusHunian::firstOrCreate([
                'nama' => $data
            ]);
        endforeach;
    }
}
