<?php

namespace ConnectU\Http\Controllers;

use DB;
use Auth;
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

		# Redirect to the home page with the message that their account has been created and they can log in

		notify()->flash('Welcome to ConnectU!', 'success', [
			'timer' => 6000,
			'text'  => 'Your account has been created! Sign in and see what ConnectU has to offer!',
		]);

		return redirect()
			->route('home');
	}

	public function getSignin()
	{
		return view('auth.signin'); # Returns the sign in view: /resources/views/auth/signin.blade.php
	}

	public function postSignin(Request $request)
	{
		# Validation to see if both fields are filled in
		$this->validate($request, [
			'email'    => 'required', # User email
			'password' => 'required', # User password
		]);

        # Try the $field  as an email or username
		$field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    	$request->merge([$field => $request->input('email')]);

		if(!Auth::attempt($request->only([$field, 'password']), $request->has('remember'))) {
			notify()->flash('Mismatch on our end', 'error', [
				'timer' => 2000,
				'text'  => 'It seems as though we cannot verify your login. Try again',
			]);

			# Return back with the message that they could not be signed in.
			return redirect()->back();
		}

        # Get the current time and assign it to the variable $current_time
		$current_time = Carbon::now()->subHours(5);

		Auth::user()->update([
			'ip'         => $_SERVER['REMOTE_ADDR'], # Get the current IP and put it on the user
			'last_activity' => $current_time, # Update the users last activity
		]);

		notify()->flash('Your are now signed in', 'success', [
			'timer' => 2000,
			'text'  => 'It\'s great to see you again, ' . Auth::user()->getFirstNameOrUsername() . '!',
		]);

		# Redirect home and with the message saying that they are signed in
		return redirect()->route('home');
	}

	public function getSignout()
	{
		# Logout the user
		Auth::logout();

		notify()->flash('You have signed out', 'info', [
			'timer' => 4000,
			'text'  => 'Come back soon!'
		]);
		# Return the user home with the message that they have been logged out
		return redirect()->route('home');
	}
}
