<?php

namespace Database\Factories;

use App\Models\Surat;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuratFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Surat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nomor_surat' => $this->faker->numerify('################'),
            'warga_id' => $this->faker->numberBetween(100, 163),
            'keperluan_surat_id' => $this->faker->numberBetween(1, 6) ,
            'tanggal_pengajuan' => Carbon::now()->format('Y-m-d'),
            'tanggal_disetujui' => Carbon::now()->format('Y-m-d'),
            'status_surat_id' => $this->faker->numberBetween(2, 4),
            'createable_id' => '1',
            'createable_type' => 'App\Models\User'
        ];
    }
}
