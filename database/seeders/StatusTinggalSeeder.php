<?php

namespace Database\Seeders;

use App\Models\StatusTinggal;
use Illuminate\Database\Seeder;

class StatusTinggalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'Warga Tinggal',
            'Pindah',
        ];

        foreach ($status as $data) :
            StatusTinggal::firstOrCreate([
                'nama' => $data
            ]);
        endforeach;
    }
}
