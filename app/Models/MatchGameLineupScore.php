<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchGameLineupScore extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'score',
        'match_game_lineup_id',
    ];

    public function rules()
    {
        return [
            'score' => 'required|numeric|between:0.01,999999.99',
            'match_game_lineup_id' => 'required|integer|exists:match_game_lineups,id',
        ];
    }

    public static function feedback()
    {
        return [
            'score.required' => 'O campo score é obrigatório.',
            'score.numeric' => 'O campo score deve ser um número.',
            'score.between' => 'O campo score deve estar entre :min e :max.',
            'match_game_lineup_id.required' => 'O campo match_game_lineup_id é obrigatório.',
            'match_game_lineup_id.integer' => 'O campo match_game_lineup_id deve ser um número inteiro.',
            'match_game_lineup_id.exists' => 'O valor do campo match_game_lineup_id não existe na tabela de match_game_lineups.',
        ];
    }

    public function matchGameLineup()
    {
        return $this->belongsTo(MatchGameLineup::class, 'match_game_lineup_id');
    }

}
