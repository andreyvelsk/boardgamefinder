<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['title', 'idtesera', 'idbgg', 'yearpublished', 'bgggeekrating', 'bggavgrating', 'bggnumvotes', 'mainplayers', 'maxplayers', 'suggestedplayers', 'minage', 'suggestedage', 'gameweight', 'minplaytime', 'maxplaytime', 'description', 'isexpansion']; 
    public function artists()
    {
        return $this->belongsToMany('App\Artist', 'games_artists', 'idgame', 'idartist');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'games_categories', 'idgame', 'idcategory');
    }

    public function designers()
    {
        return $this->belongsToMany('App\Designer', 'games_designers', 'idgame', 'iddesigner');
    }

    public function families()
    {
        return $this->belongsToMany('App\Family', 'games_families', 'idgame', 'idfamily');
    }

    public function mechanics()
    {
        return $this->belongsToMany('App\Mechanic', 'games_mechanics', 'idgame', 'idmechanic');
    }

    public function publishers()
    {
        return $this->belongsToMany('App\Publisher', 'games_publishers', 'idgame', 'idpublisher');
    }

    public function types()
    {
        return $this->belongsToMany('App\Type', 'games_types', 'idgame', 'idtype');
    }
}
