<?php

namespace ConnectU\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use ConnectU\Models\User;
use ConnectU\Models\Status;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        # Get every user in the database and paginate them 25 at a time
        $users = DB::table('users')->paginate(25);

        return view('admin.home')->with('users', $users); # Returns the main dashboard view: /resources/views/admin/home.blade.php with the $users variable
    }

    public function deleteUser($username)
    {
        # Get the user where the username row is equal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Delete the user where the username row is equal to $username
        DB::table('users')->where('username', $username)->delete();

        # Reload the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->back()->with('succ', $user->getNameOrUsername . '\'s account has been deleted!'); # Returns the user back
    }

    public function getEditUser($username)
    {
        # Get the user where the username row is equal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        return view('admin.edituser')->with('user', $user); # Returns the edit user view: /resources/views/admin/edituser.blade.php with the $user variable
    }

    public function postEditUser(Request $request, $username)
    {
        # Get the user where the username reow is queal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Validate the values
        $this->validate($request, [
            'first_name' => 'alpha|max:50',
            'last_name'  => 'alpha|max:50',
            'username'   => 'required|unique:users,username,' . $user->id . '|alpha_dash',
            'email'      => 'required|unique:users,username,' . $user->id . '|email|max:255',
            'location'   => 'max:200',
            'biography'  => 'max:160',
        ]);

        # Update the results to $user
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'sex' => $request->input('gender'),
            'location' => $request->input('location'),
            'biography' => $request->input('biography'),
        ]);

        # Reload the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->route('admin.home')->with('succ', $user->getNameOrUsername() . '\'s profile has been updated!'); # Returns the admin home view: /resources/views/admin/home.blade.php
    }

    public function metrics()
    {
        return view('admin.metrics'); # Returns the metrics view: /resources/views/admin/metrics.blade.php with the $user variable
    }

    public function userlogs($username)
    {
        # Get the user wher the username row is equal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Get the users statuses where the user_id is equal to the users id
        $statuses = Status::where('user_id', $user->id)->orderBy('id', 'desc')->get();

        return view('admin.userlogs')->with('user', $user)->with('statuses', $statuses); # Returns the userlogs view: /resources/views/admin/userlogs.blade.php with the $user variable and the $statuses variable
    }

    public function deletePost($postId)
    {
        # Update the deleted row to 1 where the status id is equal to $postId
        Status::where('id', $postId)->first()->update([
            'deleted' => 1,
        ]);

        # Update the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->route('admin.home')->with('succ', 'The post was deleted!'); # Returns the admin home view: /resources/views/admin/home.blade.php
    }

    public function getEditUserPassword($username)
    {
        # Get the user where the username row is equal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Update the users last_activity time
        Auth::user()->reloadActivityTime();

        return view('admin.userpassword')->with('user', $user); # Returns the edit user view: /resources/views/admin/editpassword.blade.php with the $user variable
    }

    public function postEditUserPassword(Request $request, $username)
    {
        # Get the user where the username row is equal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Validate the fields
        $this->validate($request, [
            'newpassword' => 'required|min:6',
            'newpassword2' => 'required|same:newpassword',
        ]);

        # Update the user's password and hash it with bcrypt
        $user->update([
            'password' => bcrypt($request->input('newpassword2')),
        ]);

        # Update the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->route('admin.home')->with('succ', $user->getNameOrUsername() . '\'s password was changed!'); # Returns the admin home view: /resources/views/admin/home.blade.php
    }

    public function promoteUser($userId)
    {
        # Get the suer where the id is equal to the $userId and get the first(and only) result
        $user = User::where('id', $userId)->first();

        # Check if there is a user present
        if (!$user) {
            return redirect()->back()->with('warn', 'No user found!'); # Redirect back with an error message
        }

        if ($user->position === NULL || $user->position === '') {
            # If the user is a default user, then promote the user to helper
            $user->update([
                'position' => 'helper',
            ]);

            return redirect()->back()->with('succ', $user->getNameOrUsername() . ' is now a Helper!'); # Redirect back
        } else if ($user->position === 'helper') {
            # If the user is a helper, then promote the user to moderator
            $user->update([
                'position' => 'mod',
            ]);

            return redirect()->back()->with('succ', $user->getNameOrUsername() . ' is now a Moderator!'); # Redirect back
        } else if ($user->position === 'mod') {
            # If the user is a moderator, throw an error saying that you cannot promote moderators through the site
            return redirect()->back()->with('dang', 'You cannot promot moderators to administrators! Please do this manually.'); # Redirect back with an error message
        }
    }

    public function demoteUser($userId)
    {
        # Get the suer where the id is equal to the $userId and get the first(and only) result
        $user = User::where('id', $userId)->first();

        # Check if there is a user present
        if (!$user) {
            return redirect()->back()->with('warn', 'No user found!'); # Redirect back with an error message
        }

        if ($user->position === NULL || $user->position === '') {
            # If the user is a default user, throw an error saying that you cannot demote default users!
            return redirect()->back()->with('warn', 'You cannot demote a user that is not staff!'); # Redirect back with an error message
        } else if ($user->position === 'helper') {
            # If the user is a helper, demote to default user!
            $user->update([
                'position' => NULL
            ]);

            return redirect()->back()->with('succ', $user->getNameOrUsername() . ' has been demoted to default!'); #Redirect back
        } else if ($user->position === 'mod') {
            # If the user is a moderator, demote to helper!
            $user->update([
                'position' => 'helper'
            ]);

            return redirect()->back()->with('succ', $user->getNameOrUsername() . ' has been demoted to helper!'); # Redirect back
        } else if ($user->position === 'admin') {
            # If the user is an administrator, throw an error saying that you cannot demote administrators!
            return redirect()->back()->with('dang', 'You cannot demote a nother administrator!'); # Redirect back with an error message!
        }
    }
}
