<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
	protected $table = 'game_user';
	protected $fillable = [
		'game_id', 'user_id', 'item_id', 'points'
	];
}
