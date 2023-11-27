<?php

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Poli::query()->count() == 0) {
            Poli::query()->create([
                'nama'           => 'Gigi dan Mulut',
            ]);
        }
    }
}
