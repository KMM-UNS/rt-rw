<?php

namespace Database\Factories;

use App\Models\RiwayatRumah;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RiwayatRumahFactory extends Factory
{
    protected $model = RiwayatRumah::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tanggal_masuk' => Carbon::now()->format('Y-m-d'),
        ];
    }
}
