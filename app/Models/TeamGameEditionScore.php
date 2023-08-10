<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teamGameEditionScore extends Model
{
    use HasFactory;

    protected $table = 't_g_e_scores';

    protected $fillable = [
        'team_game_edition_id',
        'championship_round_id',
    ];

    public static $rules = [
        'team_game_edition_id' => 'required|exists:team_game_editions,id',
        'championship_round_id' => 'required|exists:championship_rounds,id',
    ];

    public function teamGameEdition()
    {
        return $this->belongsTo(TeamGameEdition::class);
    }

    public function championshipEdition()
    {
        return $this->belongsTo(ChampionshipEdition::class);
    }

    public function championshipRound()
    {
        return $this->belongsTo(ChampionshipRound::class);
    }
}
