<?php

namespace Database\Factories;

use App\Models\PresensiRonda;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PresensiRondaFactory extends Factory
{
    protected $model = PresensiRonda::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // dd(Carbon::now()->format('Y-m-d'));
        return [
            'jadwal_ronda_id' => $this->faker->numberBetween(1, 28),
            'hari_id' => $this->faker->numberBetween(1,7),
            'tanggal' => $this->faker->dateTimeThisMonth()->format('d-m-Y'),
            'kehadiran' => 'hadir',
        ];
    }
}
