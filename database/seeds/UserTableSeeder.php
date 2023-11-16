<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'phone'          => '08123456789',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60)
            ]);
        }
    }
}
