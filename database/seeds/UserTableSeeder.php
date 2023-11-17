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
        if (!User::query()->where('role', 1)->first()) {
            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'phone'          => '08123456789',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60)
            ]);
        }

        if (!User::query()->where('role', 3)->first()) {
            User::create([
                'name'           => 'Dimas',
                'email'          => 'dimas@dimas.com',
                'phone'          => '0987654321',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role'           => 3
            ]);
        }
    }
}
