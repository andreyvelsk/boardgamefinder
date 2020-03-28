<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['id', 'name'];

    public function games() {
        return $this->belongsToMany('App\Game', 'games_types', 'idtype', 'idgame')->where('isexpansion', '!=', 1)->whereNotNull('idbgg');
    }
}
