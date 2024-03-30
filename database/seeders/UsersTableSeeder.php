<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        User::create([
            'email' => env('ADMIN_EMAIL'),
            'first_name' => env('ADMIN_FIRST_NAME'),
            'last_name' => env('ADMIN_LAST_NAME'),
            'nick' => env('ADMIN_NICK'),
            'password' => Hash::make( env('ADMIN_PASSWORD'),),
            'access_level_id' => env('ADMIN_ACCESS_LEVEL_ID')

        ]);


        User::create([
            'email' => 'hjunior854@gmail.com',
            'first_name' => 'Humberto',
            'last_name' => 'Júnior',
            'nick' => '1berto_junior',
            'password' => Hash::make('Key@2024'),
            'access_level_id' => 2

        ]);

        User::create([
            'email' => 'viktorshantus@gmail.com',
            'first_name' => 'Vitor',
            'last_name' => 'Santos',
            'nick' => 'viktorshts',
            'password' => Hash::make('Key@2024'),
            'access_level_id' => 2

        ]);
    }
}
