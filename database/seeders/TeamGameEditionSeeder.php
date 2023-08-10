<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamGameEdition;

class TeamGameEditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeamGameEdition::create([
            'team_game_id' => 1,
            'championship_edition_id' => 1
        ]);
    }
}
