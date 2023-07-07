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
    // Auth
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');

    // PROTECTED
    Route::middleware('jwt.auth')->group(function(){
        // Auth
        Route::post('logout', 'App\Http\Controllers\AuthController@logout');
        Route::post('me', 'App\Http\Controllers\AuthController@me');
        Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');

        // OTHERS
        Route::apiResource('state', 'App\Http\Controllers\StateController');
        Route::apiResource('city', 'App\Http\Controllers\CityController');

    });

});

// Route::prefix('v1')->group( function() {
//     Route::post('login', 'App\Http\Controllers\AuthController@login');
//     Route::post('register', 'App\Http\Controllers\UserController@register');
// });

// Route::prefix('v1')->middleware('jwt.auth')->group(function(){
//     // Auth
//     Route::post('logout', 'App\Http\Controllers\AuthController@logout');
//     Route::post('me', 'App\Http\Controllers\AuthController@me');
//     Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');

//     Route::apiResource('state', 'App\Http\Controllers\StateController');

// });



    // Route::apiResource('user', 'App\Http\Controllers\UserController');

    // Route::apiResource('championship', 'App\Http\Controllers\ChampionshipController');
    // Route::apiResource('championshipEdition', 'App\Http\Controllers\ChampionshipEditionController');
    // Route::apiResource('championshipRound', 'App\Http\Controllers\ChampionshipRoundController');
    // Route::apiResource('coach', 'App\Http\Controllers\CoachController');
    // Route::apiResource('matchGoalStats', 'App\Http\MatchCardsStatsControllers\MatchGoalStatsController');
    // Route::apiResource('matchGoalStats', 'App\Http\Controllers\MatchGoalStatsController');
    // Route::apiResource('matchLineup', 'App\Http\Controllers\MatchLineupController');
    // Route::apiResource('player', 'App\Http\Controllers\PlayerController');
    // Route::apiResource('playerEdition', 'App\Http\Controllers\PlayerEditionController');
    // Route::apiResource('playerGameScoreChampionshipEdition', 'App\Http\Controllers\PlayerGameScoreChampionshipEditionController');
    // Route::get('/api/playerGameScoreChampionshipEdition/{scoreEdition}', [PlayerGameScoreController::class, 'show']);
    // Route::apiResource('playerGameScore', 'App\Http\Controllers\PlayerGameScoreController');
    // Route::apiResource('positionPlayer', 'App\Http\Controllers\PositionPlayerController');
    // Route::apiResource('soccerMatch', 'App\Http\Controllers\SoccerMatchController');

    // Route::apiResource('stadiumFootballController', 'App\Http\Controllers\StadiumFootballController');
    // Route::apiResource('statusLineup', 'App\Http\Controllers\StatusLineupController');
    // Route::apiResource('substitution', 'App\Http\Controllers\SubstitutionController');
    // Route::apiResource('teamController', 'App\Http\Controllers\TeamController');
// });

// Route::apiResource('', 'App\Http\Controllers\TeamGameController');
// Route::apiResource('', 'App\Http\Controllers\TeamGameController');
// Route::apiResource('', 'App\Http\Controllers\TeamGameEditionController');
// Route::apiResource('', 'App\Http\Controllers\UserController');
//






