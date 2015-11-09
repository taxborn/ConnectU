<?php

namespace ConnectU\Http\Controllers;

use Auth;
use DB;
use ConnectU\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function getResults(Request $request)
	{
		$query = $request->input('query'); # Get the user input query

		# Check if there is any input
		if(!$query) {
            # Return back if the user did not put anything into the text box
			return redirect()->back()->with('warn', 'Please enter something into the searchbox!');
		}

		# Get all the results LIKE the query and put them into the $users variable
		$users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%$query%")
            ->orWhere('username',  'LIKE',  "%$query%")
            ->paginate(20);

        # Get the total count of results of users
		$user_count = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%$query%")
			->orWhere('username',  'LIKE',  "%$query%")
			->count();

        # Reload the users last_activity time
		Auth::user()->reloadUpdateTime(Auth::user());

		return view('search.results')->with('users', $users)->with('user_count', $user_count); # Returns the home view: /resources/views/search/results.blade.php with the $users variable
	}
}
