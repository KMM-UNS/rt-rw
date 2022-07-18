<?php

namespace Database\Factories;

use App\Models\Rumah;
use Illuminate\Database\Eloquent\Factories\Factory;

class RumahFactory extends Factory
{
   /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rumah::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'alamat' => $this->faker->address(),
            'nomor_rumah' => $this->faker->numberBetween(1, 100),
            'status_penggunaan_rumah_id' => '1',
            'status_hunian_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
