<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use App\PageRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function home()
	{
		return view('admin-layouts.home');
    }

    public function index()
    {
        $roles = PageRole::all();
        $admins = Admin::with('role')->get();

        return view('admin-layouts.index', compact(['roles', 'admins']));
    }

    public function store(Request $request)
    {
        return Admin::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'role_id' => request('role_id')
        ]);
    }
}
