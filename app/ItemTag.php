<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTag extends Model
{
	protected $table = 'item_tag';
    protected $fillable = [
        'item_id', 'tag_id'
    ];
}
