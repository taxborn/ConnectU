<?php

namespace ConnectU\Http\Controllers;

use DB;
use Auth;
use ConnectU\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function getIndex()
	{
		return view('search.index');
	}

	public function getResults(Request $request)
	{
		$query = $request->input('query'); # Get the user input query

		# Check if there is any input
		if(!$query) {
			notify()->flash('Error.', 'warning', [
				'timer' => 4000,
				'text'  => 'Please enter something into the searchbox!',
			]);

            # Return back if the user did not put anything into the text box
			return redirect()->back();
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
		Auth::user()->reloadActivityTime();

		return view('search.results')->with('users', $users)->with('user_count', $user_count); # Returns the home view: /resources/views/search/results.blade.php with the $users variable and $user_count
	}
}
