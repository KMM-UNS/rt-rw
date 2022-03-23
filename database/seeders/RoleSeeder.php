<?php

namespace Database\Seeders;

use App\Models\AdminRole;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin',
            'Ketua RW',
            'Ketua RT',
            'Sekretaris',
            'Bendahara',
            'Ketua Ronda'
        ];

        foreach ($roles as $role) :
            AdminRole::firstOrCreate([
                'nama' => $role
            ]);
        endforeach;
    }
}
