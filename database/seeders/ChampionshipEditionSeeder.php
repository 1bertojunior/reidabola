<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChampionshipEdition;
use App\Models\Championship;
use Carbon\Carbon;

class ChampionshipEditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $championship = Championship::where('name', 'Campeonato de Belém do Piauí')->first();

        if ($championship) {
            $edition = ChampionshipEdition::create([
                'year' => Carbon::now()->year,
                'start' => Carbon::create(null, 10, 1, 0, 0, 0),
                'end' => Carbon::create(null, 12, 14, 0, 0, 0),
                'championship_id' => $championship->id,
            ]);

            $this->command->info('Edição do Campeonato de Belém do Piauí criada com sucesso.');
        }
    }
}
