<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamGame;


class TeamGameSeeder extends Seeder
{

    public function run()
    {
        TeamGame::create([
            'name' => 'River',
            'abb' => 'RFC',
            'user_id' => 2,
        ]);

        TeamGame::create([
            'name' => 'Flamengo',
            'abb' => 'FLA',
            'user_id' => 3,
        ]);
    }

}
