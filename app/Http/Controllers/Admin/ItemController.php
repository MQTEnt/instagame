<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\ItemTag;
use DB;

class ItemController extends Controller
{
	public function __construct() {
    	$this->middleware('admin');
    }
    public function index(){
    	$items = Item::select()->paginate(5);
        return view('admin.items.index', ['items' => $items]);
    }
    public function create(){
        return view('admin.items.create');
    }
    public function checkName($name){
        $item = Item::select('*')->where(['name' => $name])->first();
        if($item)
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

            //Create item...
            $item = new Item();
            $item->name = $request->name;
            $item->desc = $request->desc;
            $item->rate = $request->rate;
            $item->image = 'images/'.$fileNameToStore;
            $item->save();

            //Create item - tag...
            //Add items just 1 query (Update later...)
            foreach ($tags as $value) {
                ItemTag::create([
                    'item_id' => $item->id,
                    'tag_id' => $value['id']
                ]);
            }
            
            return ['state' => 1, 'message' => 'Success'];
        }
    }
    public function show($id){
        return view('admin.items.show', ['item_id' => $id]);
    }
    public function getItemById($id){
        $item = Item::findOrFail($id);
        return $item;
    }
    public function getTagsByItemId($id){
        $tags = DB::select('
            SELECT temp_tbl.tag_id AS id, tags.name AS name FROM tags
            JOIN (SELECT * FROM item_tag WHERE item_tag.item_id = '.$id.') AS temp_tbl 
            ON (tags.id = temp_tbl.tag_id)
        ');
        return $tags;
    }
}
