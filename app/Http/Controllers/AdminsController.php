<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:admin');
	}

    //
    public function index()
    {
    	$user = Auth::user();
    	return view('admin',compact('user'));
    }
}
