<?php

namespace App\Http\Controllers\App\Ranking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

// use App\Repositories\App\Lineup\CoachLineupRepository;

class RankingRankingController extends Controller
{

    public function index(Request $request)
    {        
        // $teamEdition = new TeamEdition();

        try{
    
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

    }

}