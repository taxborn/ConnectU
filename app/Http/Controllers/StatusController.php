<?php

namespace ConnectU\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use ConnectU\Models\User;
use ConnectU\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        # Validate that the status is there and that there is less than 2500 characters
        $this->validate($request, [
            'status' => 'required|max:2500'
        ]);

        # Create the status
        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        # Reload the last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->back()->with('succ', 'Your status was posted!'); # Return back
    }

    public function postReply(Request $request, $statusId)
    {
        # Validate that the reply is there and that the text is less than 2500 characters
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:2500',
        ], [
            # Custom required error message
            'required' => 'The reply body is required.',
        ]);

        # Get the status that the user is trying to reply to
        $status = Status::notReply()->find($statusId);

        # Check if there is a real status present
        if (!$status) {
            return redirect()->route('home'); # Return back, this should not happen
        }

        # Check if the user is friends with the poster
        if (!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) {
            return redirect()->route('home'); # Return back, this should not happen
        }

        # Get the reply that was created and associate it with the current user
        $reply = Status::create([
            'body' => $request->input("reply-{$statusId}"),
        ])->user()->associate(Auth::user());

        # Save the reply
        $status->replies()->save($reply);

        # Reload the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->back()->with('succ', 'Your reply was posted.'); # Return back
    }

    public function getLike($statusId)
    {
        # Get the specified status
        $status = Status::find($statusId);

        # Check if there is a status present
        if (!$status) {
            return redirect()->route('home');
        }

        # Check if the user has already liked a status
        if (Auth::user()->hasLikedStatus($status)) {
            return redirect()->back()->with('warn', 'You cannot re-like a stauts!');
        }

        # Create the like instance and save it to the user
        $like = $status->likes()->create([]);
        Auth::user()->likes()->save($like);

        # Relaod the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->back(); # Return back, no message needed.
    }

    public function getDelete($statusId)
    {
        # Get the specified status
        $status = Status::find($statusId);

        # Check if there is a status present
        if (!$status) {
            return redirect()->route('home'); # Return home if there is no status
        }

        # Check if the logged in user is an moderator or an administrator, they have control too
        if (Auth::user()->isModAndUp(Auth::user())) {
            # Select the status and delete it
            DB::table('statuses')->where('id', $status->id)->update([
                'deleted' => 1,
            ]);

            # Relaod the users last_activity time
            Auth::user()->reloadActivityTime();

            return redirect()->back()->with('succ', 'You have deleted the post.'); # Return back
        }

        # Check if the logged in users id is equal to the original posters id
        if ($status->user_id !== Auth::user()->id) {
            return redirect()->back()->with('warn', 'You cannot delete a status that isn\'t yours!'); # Retrun back with an error message
        }

        # Delete the status
        DB::table('statuses')->where('id', $status->id)->update([
            'deleted' => 1,
        ]);

        # Reload the users last_activity time
        Auth::user()->reloadActivityTime();

        return redirect()->route('home')->with('succ', 'Your post has been deleted.'); # Return back
    }

    public function getEdit($statusId)
    {
        # Get the specified status
        $status = Status::find($statusId);

        # Check if there is a status present
        if (!$status) {
            return redirect()->back()->with('warn', 'Status not found!');
        }

        if ($status->deleted === 1) {
            return redirect()->back()->with('warn', 'Status not found!');
        }

        # Check if the user is a moderator and up
        if (Auth::user()->isModAndUp(Auth::user())) {
            return view('status.edit')->with('status', $status); # Goto the status edit route with $status
        }

        # Check if the statuses original poster is equal to the logged in user
        if ($status->user_id === Auth::user()->id) {
            return view('status.edit')->with('status', $status); # Goto the status edit route with $status
        }

        return redirect()->back()->with('warn', 'You cannot edit other users statuses!'); # Redirect back with an error message
    }

    public function postEdit(Request $request, $statusId)
	{
        # Get the specified status
		$status = Status::find($statusId);

        # Check if there is a status present
		if(!$status) {
			return redirect()->back()->with('warn', 'Status not found!');
		}

        # Check if the user is not the same as the original poster
		if($status->user_id !== Auth::user()->id)
		{
            # Check if the user is a moderator or an administrator
			if(Auth::user()->isModAndUp(Auth::user())) {
                # Update the status
				DB::table('statuses')->where('id', $statusId)->update([
					'body'       => $request->input('status'),
					'updated_at' => Carbon::now(),
					'edited'     => 1
				]);

                # Reload the users last_activity time
				Auth::user()->reloadActivityTime();

				return redirect()->back()->with('succ', 'Your status has been updated!'); # Return back
			}

			return redirect()->back()->with('warn', 'You cannot edit a status that isn\'t yours!'); # Retrun back with an error message
		}

        # Update the status
		DB::table('statuses')->where('id', $statusId)->update([
			'body'       => $request->input('status'),
			'updated_at' => Carbon::now(),
			'edited'     => 1
		]);

        # Reload the users last_activity time
		Auth::user()->reloadActivityTime();

		return redirect()->back()->with('succ', 'Your status has been updated!'); # Return back
	}
}
