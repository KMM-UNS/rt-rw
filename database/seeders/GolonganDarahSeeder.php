<?php

namespace Database\Seeders;

use App\Models\GolonganDarah;
use Illuminate\Database\Seeder;

class GolonganDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blood_group = [
            'A', 'B', 'AB', 'O'
        ];

        foreach ($blood_group as $blood) :
            GolonganDarah::firstOrCreate([
                'nama' => $blood
            ]);
        endforeach;
    }
}
