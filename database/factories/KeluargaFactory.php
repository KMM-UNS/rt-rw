<?php

namespace Database\Factories;

use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Factories\Factory;

class KeluargaFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Keluarga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_kk' => $this->faker->numerify('################'),
            'kepala_keluarga' => $this->faker->name() ,
            'rumah_id' => $this->faker->numberBetween(3, 28),
            'status_tinggal_id' => '1',
            'telp' => $this->faker->phoneNumber(),
            'createable_id' => '1',
            'createable_type' => 'App\Models\User'
        ];
    }
}
