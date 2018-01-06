<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTag extends Model
{
	protected $table = 'item_tag';
    protected $fillable = [
        'item_id', 'tag_id'
    ];
    protected $appends = ['tagName'];
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
    public function getTagNameAttribute()
	{
		return $this->tag()->first()->name;
	}
}
