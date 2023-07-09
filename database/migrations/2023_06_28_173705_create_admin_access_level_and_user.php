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

        // Criar o usuário com o nível de acesso "Admin"
        $user = new User();
        $user->email = 'admin@reidaboa.1bertojunior.com';
        $user->password = Hash::make('Admin@reidabola2023');
        $user->first_name = 'Admin';
        $user->last_name = 'Root';
        $user->nick = 'admin';
        $user->access_level_id = $accessLevelAdmin->id;
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remover o usuário com o nível de acesso "Admin"
        User::where('email', 'admin@reidaboa.1bertojunior.com')->delete();

        // Remover o nível de acesso "Admin"
        AccessLevel::where('name', 'Admin')->delete();
    }
}
