<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    protected $fillable = ['id', 'name'];

    public function games() {
        return $this->belongsToMany('App\Game', 'games_mechanics', 'idmechanic', 'idgame');
    }
}
