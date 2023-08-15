<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use App\Models\AccessLevel;
use App\Models\User;

class CreateAdminAccessLevelAndUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar o nível de acesso "Admin e Usuário"
        $accessLevelAdmin = new AccessLevel();
        $accessLevelAdmin->name = 'Admin';
        $accessLevelAdmin->save();
        $accessLevelUser = new AccessLevel();
        $accessLevelUser->name = "Usuário";
        $accessLevelUser->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover o nível de acesso "Admin"
        AccessLevel::where('name', 'Admin')->delete();
        AccessLevel::where('name', 'Usuário')->delete();
    }
}
