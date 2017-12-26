<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTag extends Model
{
    protected $fillable = [
        'item_id', 'tag_id'
    ];
}
