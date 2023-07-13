<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchGoalStats extends Model
{
    use HasFactory;

    protected $table = 'match_goal_stats';
    public $timestamps = true;

    protected $fillable = [
        'minute',
        'awn',
        'soccer_match_id',
        'player_goal_id',
        'player_assist_id',
    ];

    public function soccerMatch()
    {
        return $this->belongsTo(SoccerMatch::class, 'soccer_match_id');
    }

    public function playerGoal()
    {
        return $this->belongsTo(MatchLineup::class, 'player_goal_id');
    }

    public function playerAssist()
    {
        return $this->belongsTo(MatchLineup::class, 'player_assist_id');
    }
}
