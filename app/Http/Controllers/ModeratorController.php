<?php

namespace ConnectU\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use ConnectU\Models\User;
use ConnectU\Models\Status;
use Illuminate\Http\Request;

class ModeratorDashboard extends Controller
{
    public function home()
    {
        # Get all the users from the table 'users' and paginate them by 25
        $users = DB::table('users')->paginate(25);

        return view('moderator.home')->with('users', $users); # Return the helper dashboard view with the $users variable
    }
}
