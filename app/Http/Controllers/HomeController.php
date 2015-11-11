<?php

namespace ConnectU\Http\Controllers;

use Auth;
use ConnectU\Models\Status;

class HomeController extends Controllers
{
    public function index()
    {
        # Check if there is a user logged in and if so, get the statuses of the user and the users friends and paginate them by 20
        if (Auth::check()) {
            $statuses = Status::notReply()->where(function ($query) {
                return $query->where('user_id', Auth::user()->id)
                             ->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
            })->orderBy('created_at', 'desc')->paginate(20);

            return view('timeline.index')->with('statuses', $statues); # Return to the timeline home with the $statues variable
        }

        return view('home'); # Return the default view if the user is not logged in
    }

    public function guide()
    {
        return view('guidelines'); # Return the guidelines view
    }

    public function publicHandler()
    {
        # If the user requests /public, return home
        return redirect()->route('home');
    }
}
