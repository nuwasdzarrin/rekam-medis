<?php

use Illuminate\Database\Seeder;

class PoliTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\Poli::count() == 0) {
            \App\Models\Poli::create([
                'nama'           => 'Gigi dan Mulut',
            ]);
        }
    }
}
