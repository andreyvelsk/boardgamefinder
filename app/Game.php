<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Game extends Model
{
    use SearchableTrait;
    protected $fillable = ['title', 'idtesera', 'idbgg', 'yearpublished', 'bgggeekrating', 'bggavgrating', 'bggnumvotes', 'minplayers', 'maxplayers', 'suggestedplayers', 'minage', 'suggestedage', 'gameweight', 'minplaytime', 'maxplaytime', 'description', 'isexpansion', 'thumbnail', 'image']; 
    protected $searchable = [
        'columns' => [
            'games.title' => 20
        ]
    ];
    protected $hidden = ['pivot'];
    
    public function attributes()
    {
        return $this->belongsToMany('App\Attribute', 'games_attributes', 'idgame', 'idattribute')->whereIn('idattribute_type', [1,2,3,7]);
    }

    public function artists()
    {
        return $this->belongsToMany('App\Artist', 'games_artists', 'idgame', 'idartist');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'games_categories', 'idgame', 'idcategory');
    }

    public function expansions()
    {
        return $this->belongsToMany('App\Game', 'games_expansions', 'idgame', 'idexpansion');
    }

    public function expansionFor()
    {
        return $this->belongsToMany('App\Game', 'games_expansions', 'idexpansion', 'idgame');
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
