<?php

namespace ConnectU\Http\Controllers;

use Auth;
use DB;
use ConnectU\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile($username)
    {
        # Get the user where the username row is the same as $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Check if there is a user present
        if (!$user) {
            notify()->flash('Error.', 'error', [
    			'timer' => 4000,
    			'text'  => 'That user could not be found.',
    		]);

            return redirect()->route('home');
        }

        # Get the users statues
        $statuses = $user->statuses()->notReply()->orderBy('id', 'desc')->get();

        # Check if there is a user logged in
        if (Auth::check()) {
            return view('profile.index', ['username', $username])
                ->with('user', $user)->with('statuses', $statuses)
                ->with('authUserIsFriend', Auth::user()->isFriendsWith($user)); # Returns the profile home view
        }

        notify()->flash('Uh-oh..', 'warning', [
			'timer' => 6000,
			'text'  => 'You need to be signed in to view users profiles.',
		]);

        return redirect()->back(); # Redirects back if the user is not signed in and is trying to view a user profile
    }

    public function getEdit()
    {
        return view('profile.edit'); # Returns the profile edit view: /resources/views/profile/edit.blade.php
    }

    public function postEdit(Request $request)
    {
        # Validate the fields
        $this->validate($request, [
            'first_name' => 'alpha|max:50',
            'last_name'  => 'alpha|max:50',
            'username'   => 'required|unique:users,username,' . Auth::user()->id . '|alpha_dash',
            'email'      => 'required|unique:users,username,' . Auth::user()->id . '|email|max:255',
            'location'   => 'max:200',
            'biography'  => 'max:140',
        ]);

        # Update the database
        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'username'   => strtolower($request->input('username')),
            'email'      => $request->input('email'),
            'sex'        => $request->input('sex'),
            'location'   => $request->input('location'),
            'biography'  => $request->input('biography'),
        ]);

        # Reload the users last_activity time
        Auth::user()->reloadActivityTime();

        notify()->flash('Success!', 'success', [
			'timer' => 4000,
			'text'  => 'Your profile has been updated!',
		]);

        return redirect()->back(); # Return back
    }

    public function getDelete()
    {
        return view('profile.delete'); # Return the profile delete view
    }

    public function postDelete(Request $request)
    {
        # Use password_verify() to see if the users password is the same as in the database
        $isPasswordCorrect = password_verify($request->input('password'), Auth::user()->password);

        # Make sure the user supplied a password
        $this->validate($request, [
            'password' => 'required'
        ]);

        # Check if $isPasswordCorrect equals true(the password is the same) then delete all instances of the user
        if ($isPasswordCorrect) {
            DB::table('users')->where('id', Auth::user()->id)->delete(); # Delete the physical user
            DB::table('statuses')->where('user_id', Auth::user()->id)->delete(); # Delete all the users posts
            DB::table('likeable')->where('user_id', Auth::user()->id)->delete(); # Delete the users likes
            DB::table('friends')->where('user_id', Auth::user()->id)->delete(); # Delete the friendships where the user has initiated
            DB::table('friends')->where('friend_id', Auth::user()->id)->delete(); # Delete the friendships where the users friend has initiated

            # Log the user out
            Auth::logout();

            notify()->flash('Success!', 'success', [
    			'timer' => 4000,
    			'text'  => 'Your account has been deleted. Come back soon!',
    		]);

            return redirect()->route('home'); # Go home
        }

        notify()->flash('Correction..', 'error', [
			'timer' => 4000,
			'text'  => 'Your password appears to be incorrect. Try again.',
		]);

        return redirect()->back(); # Return back with an error message
    }

    public function getEditPassword()
    {
        return view('profile.password'); # Return the profile edit password view
    }

    public function postEditPassword(Request $request)
    {
        $isPasswordCorrect = password_verify($request->input('oldpassword'), Auth::user()->password);

        # Make sure the user has typed in all the fields
        $this->validate($request, [
            'oldpassword'  => 'required',
            'newpassword'  => 'required',
            'newpassword2' => ' required|same:newpassword',
        ]);

        # Check if the $isPasswordCorrect is true(everything passes)
        if ($isPasswordCorrect) {
            # Update the users password from the newpassword field and bcrypt hash it
            Auth::user()->update([
                'password' => bcrypt($request->input('newpassword')),
            ]);

            # Update the users last_activity time
            Auth::user()->reloadActivityTime();

            notify()->flash('Everything passes!', 'success', [
    			'timer' => 5000,
    			'text'  => 'Your password has been changed. Log out and log back in to test it out!',
    		]);

            return redirect()->route('home'); # Return home
        }

        notify()->flash('Something went wrong...', 'error', [
            'timer' => 5000,
            'text'  => 'Your password was incorrect. Try again!',
        ]);

        return redirect()->back(); # Return back
    }
}
