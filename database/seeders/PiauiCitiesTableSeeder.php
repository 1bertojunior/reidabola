<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PiauiCitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stateId = 18; // ID do estado do Piauí

        $cities = [
            ['name' => 'Teresina', 'abb' => 'THE', 'state_id' => $stateId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Parnaíba', 'abb' => 'PHB', 'state_id' => $stateId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Picos', 'abb' => 'PIC', 'state_id' => $stateId, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Belém do Piauí', 'abb' => 'BP', 'state_id' => $stateId, 'created_at' => now(), 'updated_at' => now()],
            // Adicione mais cidades do Piauí aqui...
        ];

        DB::table('cities')->insert($cities);
    }
}
