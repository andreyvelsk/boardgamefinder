<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeType extends Model
{
    protected $table = 'attributes_types';
    protected $fillable = ['id', 'name', 'bggname'];
}
