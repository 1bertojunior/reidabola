<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'admin@reidabola.com',
            'first_name' => 'Admin',
            'last_name' => 'Rei da Bola',
            'nick' => 'admin',
            'password' => '$2y$10$oYo/A16beLUup.Sy.8OioO4lR1YyhQhaggzFJR43sXaQLDK6mZeIm',
            'access_level_id' => 1

        ]);

        User::create([
            'email' => 'hjunior854@gmail.com',
            'first_name' => 'Humberto',
            'last_name' => 'Júnior',
            'nick' => '1berto_junior',
            'password' => '$2y$10$/aMD5iKs4g8cnbl8ASon3eWcBusSHG41FivrLUuDPmSgKLmfmnGdu',
            'access_level_id' => 2

        ]);

        User::create([
            'email' => 'viktorshantus@gmail.com',
            'first_name' => 'Vitor',
            'last_name' => 'Santos',
            'nick' => 'viktorshts',
            'password' => '$2y$10$oYo/A16beLUup.Sy.8OioO4lR1YyhQhaggzFJR43sXaQLDK6mZeIm',
            'access_level_id' => 2

        ]);
    }
}
