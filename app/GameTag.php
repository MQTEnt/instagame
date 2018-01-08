<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameTag extends Model
{
	protected $table = 'game_tag';
	protected $fillable = [
		'game_id', 'tag_id'
	];
}
