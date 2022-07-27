<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

class WargaFactory extends Factory
{
    protected $model = Warga::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'keluarga_id' => $this->faker->numberBetween(10,24) ,
            'nik' => $this->faker->numerify('################'),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => 'laki-laki',
            'agama_id' => $this->faker->numberBetween(1,8) ,
            'golongan_darah_id' => $this->faker->numberBetween(1,4),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date() ,
            'warga_negara_id' => $this->faker->numberBetween(1,2),
            'pendidikan_id' => $this->faker->numberBetween(1,7),
            'pekerjaan_id' => $this->faker->numberBetween(1,7),
            'status_keluarga_id' => 1,
            'status_kawin_id' => $this->faker->numberBetween(1,4),
            'alamat' => $this->faker->address(),
            'status_warga_id' => $this->faker->numberBetween(1,2)
        ];
    }
}
