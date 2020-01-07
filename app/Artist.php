<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function games()
    {
        return $this->belongsToMany('App\Game', 'games_artists', 'idgame', 'idartist');
    }
}
