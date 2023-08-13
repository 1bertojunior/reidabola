<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchLineupScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'match_lineup_id',
    ];

    public function matchLineup()
    {
        return $this->belongsTo(MatchLineup::class, 'match_lineup_id');
    }

}
