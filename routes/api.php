<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('test', function(){
    	//Get current User with token on url
    	$user = JWTAuth::parseToken()->authenticate();

        return response()->json(['user' => $user]);
    });
    Route::get('game/{id}', function($id){
    	$collection = App\GameTag::where('game_id', '=', $id)
						    	->with(['tag.item_tag.item'])
						    	->get();
		$items = $collection->pluck('tag')
							->pluck('item_tag')->collapse()
							->pluck('item')
							->unique('id');
		$item_array = $items->mapWithKeys(function ($item) {
	   		return [$item['id'] => 11 - $item['rate']];
		});
		$item_array = $item_array->toArray();
		$rand = mt_rand(1, (int) array_sum($item_array));
		foreach ($item_array as $key => $value) {
			$rand -= $value;
			if ($rand <= 0) {
				$i = $key;
				break;
			}
		}
		$sellected_item = $items->where('id', $i)->first();
		
		$user = JWTAuth::parseToken()->authenticate();
		$user->points = $user->points + $sellected_item->rate;
		$user->save();

		App\GameUser::create([
			'game_id' => $id,
			'user_id' => $user->id,
			'item_id' => $sellected_item->id,
			'points' => $sellected_item->rate
		]);

		return [$user, $sellected_item];
    });
});