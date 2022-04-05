<?php

namespace Database\Seeders;

use App\Models\WargaNegara;
use Illuminate\Database\Seeder;

class WargaNegaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'Indonesia',
            'Asing',
        ];

        foreach ($status as $data) :
            WargaNegara::firstOrCreate([
                'nama' => $data
            ]);
        endforeach;
    }
}
