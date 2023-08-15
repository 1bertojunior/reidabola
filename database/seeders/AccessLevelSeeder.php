<?php

namespace Database\Seeders;

use App\Models\AccessLevel;
use Illuminate\Database\Seeder;
use App\Models\ChampionshipEdition;
use App\Models\Championship;

class AccessLevelSeeder extends Seeder
{
    public function run()
    {
    
        $rootAccess = new AccessLevel();
        $rootAccess->name = 'root';
        $rootAccess->save();

        $userAccess = new AccessLevel();
        $userAccess->name = 'usuário';
        $userAccess->save();

    }
}
