<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class AdminController extends Controller
{
    public function __construct() {
    	$this->middleware('admin',['except' => 'getLogout']);
    }
    public function index()
    {
        return view('admin.layout.master');
    }
    public function getLogout() {
    	Auth::guard('admin')->logout();
    	return redirect('admin/login');
    }
 }