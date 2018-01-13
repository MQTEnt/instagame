<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'desc'
    ];
    public function item_tag()
    {
        return $this->hasMany('App\ItemTag');
    }
}
