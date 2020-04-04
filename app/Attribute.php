<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['id', 'idbgg', 'name', 'bggname'];

    public function type()
    {
        return $this->hasOne('App\AttributeType', 'id', 'idattribute_type');
    }
}
