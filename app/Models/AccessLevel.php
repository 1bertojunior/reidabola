<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    protected $table = 'access_levels';

    protected $fillable = [
        'name',
    ];

    // Relação com os usuários
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
