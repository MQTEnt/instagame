<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ItemTag;

class Item extends Model
{
    protected $fillable = [
        'name', 'desc', 'rate', 'image'
    ];
    public function getTags(){
    	$tags = ItemTag::where('item_id', $this->id)->get();
    	return $tags;
    }
}
