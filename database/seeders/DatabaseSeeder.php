<?php

namespace Database\Seeders;

use App\Models\StadiumFootball;
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
        // \App\Models\User::factory(10)->create();
        $this->call(StatesTableSeeder::class);
        $this->call(PiauiCitiesTableSeeder::class);
        $this->call(StadiumFootballTableSeeder::class);
        $this->call(ChampionshipSeeder::class);
        $this->call(ChampionshipEditionSeeder::class);
        $this->call(CoachSeeder::class);

    }
}
