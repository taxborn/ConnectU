<?php

namespace ConnectU\Http\Controllers;

use DB;
use Auth;
use Mail;
use Carbon\Carbon;
use ConnectU\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function getSignup()
	{
		return view('auth.signup'); # Returns the signup view: /resources/views/auth/signup.blade.php
	}

	public function postSignup(Request $request)
	{
		# Validate the $request
		$this->validate($request, [
			'email'    => 'required|unique:users|email|max:255',
			'username' => 'required|unique:users|alpha_dash|max:32',
			'password' => 'required|min:6',
		]);

		# Create the user
		User::create([
			'email'    => $request->input('email'), # User email
			'username' => strtolower($request->input('username')), # User username
			'ip'       => $_SERVER['REMOTE_ADDR'], # User IP
			'password' => bcrypt($request->input('password')), # User password encrypted in Bcrypt
		]);

		// Redirect to the home page with the message that their account has been created and they can log in
		return redirect()
			->route('home')
			->with('succ', 'Your account has been created, and you can now sign in!');
	}

	public function getSignin()
	{
		return view('auth.signin'); // Returns the signin view: /resources/views/auth/signin.blade.php
	}

	public function postSignin(Request $request)
	{
		// Validation to see if both fields are filled in
		$this->validate($request, [
			'email'    => 'required',
			'password' => 'required',
		]);

		$field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    	$request->merge([$field => $request->input('email')]);

		if(!Auth::attempt($request->only([$field, 'password']), $request->has('remember'))) {
			// Return back with the message that they could not be signed in.
			return redirect()->back()->with('dang', 'Could not sign you in with those details.');
		}

		$ct = Carbon::now()->subHours(5);

		Auth::user()->update([
			'ip'         => $_SERVER['REMOTE_ADDR'],
			'last_login' => $ct,
		]);
		// Redirect home and with the message saying that they are signed in
		return redirect()->route('home')->with('succ', 'You are now signed in!');
	}

	public function getSignout()
	{
		// Logout the user
		Auth::logout();

		// Return the user home with the message that they have been logged out
		return redirect()->route('home')->with('succ', 'You have been logged out.');
	}
}
