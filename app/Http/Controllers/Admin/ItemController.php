<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

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
}
