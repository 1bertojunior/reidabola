<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

#Route::middleware('auth:api')->get('/user', function (Request $request) {
    #return $request->user();
#});

Route::get('/', function () {
    return [
        "success" => true
    ];
});

Route::prefix('v1')->group(function () {
    // ATH ROUTES PUBLIC
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');

    // PROTECTED
    Route::middleware('jwt.auth')->group(function(){
        // AUTH ROUTES PROTECTED
        Route::post('logout', 'App\Http\Controllers\AuthController@logout');
        Route::post('me', 'App\Http\Controllers\AuthController@me');
        Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');

        // ROUTES ADMIN
        Route::middleware(['access.level:1'])->group(function () {
            // Rotas acessíveis apenas para usuários com nível de acesso 1
            Route::apiResource('accessLevel', 'App\Http\Controllers\AccessLevelController');
            Route::apiResource('state', 'App\Http\Controllers\StateController');
            Route::apiResource('city', 'App\Http\Controllers\CityController');
            Route::apiResource('stadium', 'App\Http\Controllers\StadiumFootballController');
            Route::apiResource('championship', 'App\Http\Controllers\ChampionshipController');
            Route::apiResource('coach', 'App\Http\Controllers\CoachController');
            Route::apiResource('positionPlayer', 'App\Http\Controllers\PositionPlayerController');
            Route::apiResource('player', 'App\Http\Controllers\PlayerController');
            Route::apiResource('team', 'App\Http\Controllers\TeamController');
            
            Route::apiResource('statusLineup', 'App\Http\Controllers\StatusLineupController');

        });

        // ROUTER USER
        Route::apiResource('teamGame', 'App\Http\Controllers\TeamGameController');


    });

});
