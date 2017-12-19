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
    public function getIndex()
    {
        $admin = Auth::guard('admin')->user();
    	return $admin;
    }
    public function getLogout() {
    	Auth::guard('admin')->logout();
    	return redirect('admin/login');
    }
 }