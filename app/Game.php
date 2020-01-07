<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $primaryKey = 'id';
    public function artists()
    {
        return $this->belongsToMany('App\Artist', 'games_artists', 'idgame', 'idartist');
    }
}
