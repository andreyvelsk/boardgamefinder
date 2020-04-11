<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['id', 'idbgg', 'name', 'bggname'];
    protected $hidden = ['pivot'];

    public function type()
    {
        return $this->hasOne('App\AttributeType', 'id', 'idattribute_type')->select('id', 'name', 'bggname');
    }
    public function games()
    {
        return $this->belongsToMany('App\Game', 'games_attributes', 'idattribute', 'idgame')->select('id','title', 'bgggeekrating', 'thumbnail')->where('isexpansion', '!=', 1)->whereNotNull('idbgg');
    }
}
