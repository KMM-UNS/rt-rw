<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AgamaSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\PekerjaanSeeder;
use Database\Seeders\IndoRegionSeeder;
use Database\Seeders\PendidikanSeeder;
use Database\Seeders\StatusKawinSeeder;
use Database\Seeders\StatusWargaSeeder;
use Database\Seeders\StatusHunianSeeder;
use Database\Seeders\GolonganDarahSeeder;
use Database\Seeders\StatusKeluargaSeeder;
use Database\Seeders\StatusPenggunaanRumahSeeder;

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
            // SettingSeeder::class,
            LaravelEntrustSeeder::class,
            IndoRegionSeeder::class,
            AgamaSeeder::class,
            PekerjaanSeeder::class,
            PendidikanSeeder::class,
            StatusKawinSeeder::class,
            GolonganDarahSeeder::class,
            KeperluanSuratSeeder::class,
            StatusKeluargaSeeder::class,
            StatusWargaSeeder::class,
            StatusSuratSeeder::class,
            StatusPenggunaanRumahSeeder::class,
            StatusHunianSeeder::class,
            StatusTinggalSeeder::class,
            WargaNegaraSeeder::class,
            HariSeeder::class
        ]);
    }
}
