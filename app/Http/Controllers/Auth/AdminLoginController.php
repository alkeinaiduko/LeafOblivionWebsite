<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest:admin', ['except' => ['logout']]);
	}

    public function showLoginForm()
    {
    	return view('auth.admin-login');
    }

    public function login(Request $request)
    {
    	// Validate the form data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:8'
    	]);

    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password
    	];

    	// Attempt to log the user in
    	if(Auth::guard('admin')->attempt($credentials, $request->remember)) {
    		// If successful, then redirect to their intended location
    		return redirect()->intended(route('admin.dashboard'));
    	}

    	// If unsuccessful, then redirect back to the login with the form data
    	return redirect()->back()->withInput($request->only('email', 'remember'))->with(
            'error', 'Wrong email or password, please try again.',
        );
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}