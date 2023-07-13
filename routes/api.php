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
    // AUTH ROUTES PUBLIC
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');

    // PROTECTED
    Route::middleware('jwt.auth')->group(function(){
        // AUTH ROUTES PROTECTED
        Route::post('logout', 'App\Http\Controllers\AuthController@logout');
        Route::post('me', 'App\Http\Controllers\AuthController@me');
        Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');

        // ROUTER USER
        Route::apiResource('teamGame', 'App\Http\Controllers\TeamGameController');



        // INDEX AND SHOW USER
        Route::get('accessLevel', 'App\Http\Controllers\AccessLevelController@index');
        Route::get('accessLevel/{id}', 'App\Http\Controllers\AccessLevelController@show');

        // Route::get('name', 'App\Http\Controllers\nameController@index');
        // Route::get('name/{id}', 'App\Http\Controllers\nameController@show');

        Route::get('state', 'App\Http\Controllers\StateController@index');
        Route::get('state/{id}', 'App\Http\Controllers\StateController@show');

        Route::get('city', 'App\Http\Controllers\CityController@index');
        Route::get('city/{id}', 'App\Http\Controllers\CityController@show');

        Route::get('stadium', 'App\Http\Controllers\StadiumFootballController@index');
        Route::get('stadium/{id}', 'App\Http\Controllers\StadiumFootballController@show');

        Route::get('championship', 'App\Http\Controllers\ChampionshipController@index');
        Route::get('championship/{id}', 'App\Http\Controllers\ChampionshipController@show');

        Route::get('coach', 'App\Http\Controllers\CoachController@index');
        Route::get('coach/{id}', 'App\Http\Controllers\CoachController@show');

        Route::get('positionPlayer', 'App\Http\Controllers\PositionPlayerController@index');
        Route::get('positionPlayer/{id}', 'App\Http\Controllers\PositionPlayerController@show');

        Route::get('player', 'App\Http\Controllers\PlayerController@index');
        Route::get('player/{id}', 'App\Http\Controllers\PlayerController@show');

        Route::get('team', 'App\Http\Controllers\TeamController@index');
        Route::get('team/{id}', 'App\Http\Controllers\TeamController@show');

        Route::get('teamEdition', 'App\Http\Controllers\TeamEditionController@index');
        Route::get('teamEdition/{id}', 'App\Http\Controllers\TeamEditionController@show');

        Route::get('playerEdition', 'App\Http\Controllers\PlayerEditionController@index');
        Route::get('playerEdition/{id}', 'App\Http\Controllers\PlayerEditionController@show');

        Route::get('statusLineup', 'App\Http\Controllers\StatusLineupController@index');
        Route::get('statusLineup/{id}', 'App\Http\Controllers\StatusLineupController@show');

        Route::get('championshipRound', 'App\Http\Controllers\ChampionshipRoundController@index');
        Route::get('championshipRound/{id}', 'App\Http\Controllers\ChampionshipRoundController@show');

        Route::get('soccerMatch', 'App\Http\Controllers\SoccerMatchController@index');
        Route::get('soccerMatch/{id}', 'App\Http\Controllers\SoccerMatchController@show');        

        Route::get('matchLineup', 'App\Http\Controllers\MatchLineupController@index');
        Route::get('matchLineup/{id}', 'App\Http\Controllers\MatchLineupController@show');        

        Route::get('substitution', 'App\Http\Controllers\SubstitutionController@index');
        Route::get('substitution/{id}', 'App\Http\Controllers\SubstitutionController@show');        

        // ROUTES ADMIN
        Route::middleware(['access.level:1'])->group(function () {
            // Rotas acessíveis apenas para usuários com nível de acesso 1
            // Route::apiResource('accessLevel', 'App\Http\Controllers\AccessLevelController');
            Route::post('accessLevel', 'App\Http\Controllers\AccessLevelController@store');
            Route::put('accessLevel/{id}', 'App\Http\Controllers\AccessLevelController@update');
            Route::delete('accessLevel/{id}', 'App\Http\Controllers\AccessLevelController@destroy');

            // Route::apiResource('state', 'App\Http\Controllers\StateController');
            Route::post('state', 'App\Http\Controllers\StateController@store');
            Route::put('state/{id}', 'App\Http\Controllers\StateController@update');
            Route::delete('state/{id}', 'App\Http\Controllers\StateController@destroy');

            // Route::apiResource('city', 'App\Http\Controllers\CityController');
            Route::post('city', 'App\Http\Controllers\CityController@store');
            Route::put('city/{id}', 'App\Http\Controllers\CityController@update');
            Route::delete('city/{id}', 'App\Http\Controllers\CityController@destroy');

            // Route::apiResource('stadium', 'App\Http\Controllers\StadiumFootballController');
            Route::post('stadium', 'App\Http\Controllers\StadiumFootballController@store');
            Route::put('stadium/{id}', 'App\Http\Controllers\StadiumFootballController@update');
            Route::delete('stadium/{id}', 'App\Http\Controllers\StadiumFootballController@destroy');

            // Route::apiResource('championship', 'App\Http\Controllers\ChampionshipController');
            Route::post('championship', 'App\Http\Controllers\ChampionshipController@store');
            Route::put('championship/{id}', 'App\Http\Controllers\ChampionshipController@update');
            Route::delete('championship/{id}', 'App\Http\Controllers\ChampionshipController@destroy');

            // Route::apiResource('coach', 'App\Http\Controllers\CoachController');
            Route::post('coach', 'App\Http\Controllers\CoachController@store');
            Route::put('coach/{id}', 'App\Http\Controllers\CoachController@update');
            Route::delete('coach/{id}', 'App\Http\Controllers\CoachController@destroy');

            // Route::apiResource('positionPlayer', 'App\Http\Controllers\PositionPlayerController');
            Route::post('positionPlayer', 'App\Http\Controllers\PositionPlayerController@store');
            Route::put('positionPlayer/{id}', 'App\Http\Controllers\PositionPlayerController@update');
            Route::delete('positionPlayer/{id}', 'App\Http\Controllers\PositionPlayerController@destroy');

            // Route::apiResource('player', 'App\Http\Controllers\PlayerController');
            Route::post('player', 'App\Http\Controllers\PlayerController@store');
            Route::put('player/{id}', 'App\Http\Controllers\PlayerController@update');
            Route::delete('player/{id}', 'App\Http\Controllers\PlayerController@destroy');

            // Route::apiResource('team', 'App\Http\Controllers\TeamController');
            Route::post('team', 'App\Http\Controllers\TeamController@store');
            Route::put('team/{id}', 'App\Http\Controllers\TeamController@update');
            Route::delete('team/{id}', 'App\Http\Controllers\TeamController@destroy');

            // Route::apiResource('teamEdition', 'App\Http\Controllers\TeamEditionController');
            Route::post('teamEdition', 'App\Http\Controllers\TeamEditionController@store');
            Route::put('teamEdition/{id}', 'App\Http\Controllers\TeamEditionController@update');
            Route::delete('teamEdition/{id}', 'App\Http\Controllers\TeamEditionController@destroy');

            // Route::apiResource('playerEdition', 'App\Http\Controllers\PlayerEditionController');
            Route::post('playerEdition', 'App\Http\Controllers\PlayerEditionController@store');
            Route::put('playerEdition/{id}', 'App\Http\Controllers\PlayerEditionController@update');
            Route::delete('playerEdition/{id}', 'App\Http\Controllers\PlayerEditionController@destroy');
            
            // Route::apiResource('statusLineup', 'App\Http\Controllers\StatusLineupController');
            Route::post('statusLineup', 'App\Http\Controllers\StatusLineupController@store');
            Route::put('statusLineup/{id}', 'App\Http\Controllers\StatusLineupController@update');
            Route::delete('statusLineup/{id}', 'App\Http\Controllers\StatusLineupController@destroy');

            // Route::apiResource('championshipRound', 'App\Http\Controllers\ChampionshipRoundController');
            Route::post('championshipRound', 'App\Http\Controllers\ChampionshipRoundController@store');
            Route::put('championshipRound/{id}', 'App\Http\Controllers\ChampionshipRoundController@update');
            Route::delete('championshipRound/{id}', 'App\Http\Controllers\ChampionshipRoundController@destroy');

            // Route::apiResource('soccerMatch', 'App\Http\Controllers\SoccerMatchController');
            Route::post('soccerMatch', 'App\Http\Controllers\SoccerMatchController@store');
            Route::put('soccerMatch/{id}', 'App\Http\Controllers\SoccerMatchController@update');
            Route::delete('soccerMatch/{id}', 'App\Http\Controllers\SoccerMatchController@destroy');

            Route::post('matchLineup', 'App\Http\Controllers\MatchLineupController@store');
            Route::put('matchLineup/{id}', 'App\Http\Controllers\MatchLineupController@update');
            Route::delete('matchLineup/{id}', 'App\Http\Controllers\MatchLineupController@destroy');

            Route::post('substitution', 'App\Http\Controllers\SubstitutionController@store');
            Route::put('substitution/{id}', 'App\Http\Controllers\SubstitutionController@update');
            Route::delete('substitution/{id}', 'App\Http\Controllers\SubstitutionController@destroy');
            

            // STORE, UPDATE AND DESTROY BY ADMIN ADMIN
            // Route::post('name', 'App\Http\Controllers\nameController@store');
            // Route::put('name/{id}', 'App\Http\Controllers\nameController@update');
            // Route::delete('name/{id}', 'App\Http\Controllers\nameController@destroy');

        });

    });

});
