<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\GameTag;
use DB;

class GameController extends Controller
{
	public function __construct() {
    	$this->middleware('admin');
    }
    public function index(){
    	$games = Game::select()->paginate(5);
        return view('admin.games.index', ['games' => $games]);
    }
    public function create(){
        return view('admin.games.create');
    }
    public function checkName($name){
        $game = Game::select('*')->where(['name' => $name])->first();
        if($game)
            return ['state' => 0, 'message' => 'This name was used before'];
        else
            return ['state' => 1, 'message' => 'Ok'];
    }
    public function store(Request $request){
        //Validate on server (Update later...)

        $tags = json_decode($request->tags, true);
        if(count($tags) > 0){
            if($request->hasFile('image'))
            {
                $fileNameExt = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
                $fileExt = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
                $pathToStore = $request->file('image')->storeAs('public/images',$fileNameToStore);
            }
            else
                return ['state' => 0, 'message' => 'Error'];

            //Create game...
            $game = new Game();
            $game->name = $request->name;
            $game->desc = $request->desc;
            $game->rate = $request->rate;
            $game->image = 'images/'.$fileNameToStore;
            $game->save();

            //Create game - tag...
            //Add game_tag just 1 query (Update later...)
            foreach ($tags as $value) {
                GameTag::create([
                    'game_id' => $game->id,
                    'tag_id' => $value['id']
                ]);
            }
            
            return ['state' => 1, 'message' => 'Success'];
        }
    }
    public function show($id){
        return view('admin.games.show', ['game_id' => $id]);
    }
    public function getGameById($id){
        $game = Game::findOrFail($id);
        return $game;
    }
    public function getTagsByGameId($id){
        $tags = DB::select('
            SELECT temp_tbl.tag_id AS id, tags.name AS name FROM tags
            JOIN (SELECT * FROM game_tag WHERE game_tag.game_id = '.$id.') AS temp_tbl 
            ON (tags.id = temp_tbl.tag_id)
        ');
        return $tags;
    }
    public function update($id, Request $request){
        $game = Game::findOrFail($id);
        //Validate on server (Update later...)

        $tags = json_decode($request->tags, true);

        //Validate if current tags == removed_arr && added_arr == []
        if($request->hasFile('image')){
            //New image
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('image')->storeAs('public/images',$fileNameToStore);

            //Delete image
            unlink(storage_path('app/public/'.$game->image));

            $game->image = 'images/'.$fileNameToStore;
        }

        //Update game
        $game->name = $request->name;
        $game->desc = $request->desc;
        $game->rate = $request->rate;
        $game->save();

        //Update game-tag
        //Update game_tag just 1 query (Update later...)
        foreach ($tags[0] as $value) {
            GameTag::create([
                'game_id' => $game->id,
                'tag_id' => $value['id']
            ]);
        }
        foreach ($tags[1] as $value) {
            $game_tag = GameTag::where([
                ['tag_id', '=', $value['id']],
                ['game_id', '=', $game->id]
            ]);
            $game_tag->delete();
        }

        return ['state' => 1, 'message' => 'Success'];
    }
    public function destroy($id){
        $game = Game::findOrFail($id);
        //Delete image
        unlink(storage_path('app/public/'.$game->image));
        
        $game->delete();
        return ['state' => 1, 'message' => 'Delete'];
    }
}
