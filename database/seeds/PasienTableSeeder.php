<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Pasien;

class PasienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Pasien::count() == 0) {
            Pasien::create([
                'no_rm'           => 'DD-01',
                'nama'           => 'Pasien 1'
            ]);
        }
    }
}
