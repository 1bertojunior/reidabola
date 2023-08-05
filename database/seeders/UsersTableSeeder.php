<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'viktorshantuss@gmail.com',
            'first_name' => 'Vitor',
            'last_name' => 'Santos',
            'nick' => 'viktorshts',
            'password' => '$2y$10$oYo/A16beLUup.Sy.8OioO4lR1YyhQhaggzFJR43sXaQLDK6mZeIm',
            'access_level_id' => 2

        ]);
    }
}
