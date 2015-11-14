<?php

namespace ConnectU\Http\Controllers;

use Auth;
use ConnectU\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getIndex()
    {
        # Get the users friends
        $friends = Auth::user()->friends();
        # Get the users pending friend requests
        $requests = Auth::user()->friendRequests();

        return view('friends.index')->with('friends', $friends)->with('requests', $requests); # Returns the main friends view: /resources/views/friends/home.blade.php with the $friends variable and the $requests variable
    }

    public function getAdd($username)
    {
        # Get the user where the username row is equal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Check if there is a user present
        if (!$user) {
            notify()->flash('Error.', 'warning', [
    			'timer' => 4000,
                'text'  => 'That user could not be found. Please try again.',
    		]);

            return redirect()->back(); # Return back with an error
        }

        # Make sure that the user is not trying to add their self
        if (Auth::user()->id === $user->id) {
            return redirect()->route('home'); # Redirect home, no error message because this shouldn't happen anyways
        }

        # Check if a friend request is already pending
        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            notify()->flash('Error.', 'warning', [
    			'timer' => 4000,
                'text'  => 'There is already a friend request pending. Accept it or wait for the other user to accept!',
    		]);

            return redirect()->route('profile.index', ['username' => $username]); # Return back with an error message
        }

        # Check to see if the user is already friends with the requested friend
        if (Auth::user()->isFriendsWith($user)) {
            notify()->flash('Error.', 'warning', [
    			'timer' => 4000,
                'text'  => 'You and ' . $user->getFirstNameOrUsername() . ' are already friends!',
    		]);

            return redirect()->route('profile.index', ['username' => $username]); # Return back with an error message
        }

        # Add as a friend
        Auth::user()->addFriend($user);

        # Reload the last_activity time
        Auth::user()->reloadActivityTime();

        notify()->flash('Success!', 'success', [
            'timer' => 4000,
            'text'  => 'You have sent a friend request to ' . $user->getNameOrUsername(),
        ]);

        return redirect()->route('profile.index', ['username' => $username]); # Return to the profile home page
    }

    public function getAccept($username)
    {
        # Get the user where the username row is equal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Check if there is a user present
        if (!$user) {
            notify()->flash('Error.', 'warning', [
    			'timer' => 4000,
                'text'  => 'That user could not be found. Please try again.',
    		]);

            return redirect()->back(); # Return back with an error
        }

        # Check to see if the user is trying to accept a friend request for a nother user(not allowed)
        if (!Auth::user()->hasFriendRequestReceived($user)) {
            return redirect()->route('home');
        }

        # Accept the friend request
        Auth::user()->acceptFriendRequest($user);

        # Update the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->route('profile.index', ['username' => $username])->with('succ', 'You are now friends with ' . $user->getFirstNameOrUsername()); # Return to the profile home page
    }

    public function getRemove($username)
    {
        # Get the user where the username row is equal to $username and get the first(and only) result
        $user = User::where('username', $username)->first();

        # Check if there is a user present
        if (!$user) {
            return redirect()->back()->with('warn', 'That user could not be found.');
        }

        # Check if there is a friend request pending
        if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()->route('profile.index', ['username' => $username])->with('warn', 'There is a friend request pending, accept it to continue.'); # Return the the profile home page with an error message
        }

        # Remove the friendship
        Auth::user()->removeFriend($user);

        # Reload the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->route('profile.index', ['username' => $username])->with('succ', 'You and ' . $user->getFirstNameOrUsername() . ' are no longer friends.');
    }
}
