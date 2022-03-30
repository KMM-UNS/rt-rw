<?php

namespace Database\Seeders;

use App\Models\StatusPenggunaanRumah;
use Illuminate\Database\Seeder;

class StatusPenggunaanRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'Tempat Tinggal',
            'Tempat Usaha',
        ];

        foreach ($status as $data) :
            StatusPenggunaanRumah::firstOrCreate([
                'nama' => $data
            ]);
        endforeach;
    }
}
