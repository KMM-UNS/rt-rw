<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AgamaSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\PekerjaanSeeder;
use Database\Seeders\IndoRegionSeeder;
use Database\Seeders\PendidikanSeeder;
use Database\Seeders\StatusKawinSeeder;
use Database\Seeders\StatusKeluargaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            IndoRegionSeeder::class,
            AgamaSeeder::class,
            PekerjaanSeeder::class,
            PendidikanSeeder::class,
            StatusKawinSeeder::class,
            SettingSeeder::class,
            RoleSeeder::class,
            GolonganDarahSeeder::class,
            StatusKeluargaSeeder::class
        ]);
    }
}
