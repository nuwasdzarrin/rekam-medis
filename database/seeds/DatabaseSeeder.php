<?php

use Illuminate\Database\Seeder;

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
             UserTableSeeder::class,
             PoliTableSeeder::class,
             DokterTableSeeder::class,
             PasienTableSeeder::class,
         ]);
    }
}
