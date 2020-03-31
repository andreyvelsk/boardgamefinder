<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = ['id', 'name'];
    
    public function games() {
        return $this->belongsToMany('App\Game', 'games_families', 'idfamily', 'idgame')->select('id','title', 'bgggeekrating')->where('isexpansion', '!=', 1)->whereNotNull('idbgg');
    }
}
