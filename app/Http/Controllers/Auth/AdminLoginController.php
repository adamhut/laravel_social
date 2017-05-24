<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    
	public function __contruct()
	{
		$this->middleware('guest:admin')->except(['logout']);
	}

    public function showLoginForm()
    {
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {
    	//validate the form 
    	$this->validate($request,[
    		'email'=> 'required|email',
    		'password' => 'required|min:6'
    	]);

    	$credentials= [
    		'email' => $request->email,
    		'password' => $request->password,
    	];
    	$remember = $request->remember ;

    	//attempt to log the user in
    	if(Auth::guard('admin')->attempt($credentials,$remember))
    	{
    		//if successful then redirect to their intended location
    		return redirect()->intended(route('admin.dashboard'));
    	}   	

    	//if unsuccessful then redirect back to the login with form data
    	return redirect()->back()->withInput($request->only('email','remember'));

    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        //$request->session()->flush();
        //$request->session()->regenerate();

        return redirect()->route();
    }
}
