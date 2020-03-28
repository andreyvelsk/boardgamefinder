<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name'];

    public function games() {
        return $this->belongsToMany('App\Game', 'games_categories', 'idcategory', 'idgame')->where('isexpansion', '!=', 1)->whereNotNull('idbgg');
    }
}
