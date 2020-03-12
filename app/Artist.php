<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = ['id', 'name'];
    public function games()
    {
        return $this->belongsToMany('App\Game', 'games_artists', 'idgame', 'idartist');
    }
}
