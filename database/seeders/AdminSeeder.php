<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'AshmoonStar-Admin',
            'email' => env('ADMIN_EMAIL', 'ashmoonstar32123@gmail.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'role' => 'admin',
        ]);
    }
}
