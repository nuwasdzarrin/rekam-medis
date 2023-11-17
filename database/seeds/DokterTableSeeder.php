<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Dokter;

class DokterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Dokter::count() == 0) {
            $doctor = \App\User::query()->where('role', 3)->first();
            $poli = \App\Models\Poli::query()->first();
            if ($doctor && $poli) {
                Dokter::create([
                    'user_id'        => $doctor->id,
                    'nama'           => 'Dimas',
                    'no_hp'          => '0987654321',
                    'poli'           => $poli->id,
                ]);
            }
        }
    }
}
