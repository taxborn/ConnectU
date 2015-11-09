<?php

namespace ConnectU\Models;

use DB;
use Auth;
use Carbon\Carbon;
use ConnectU\Models\Status;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
    * The dates in the project
    *
    * @var array
    */

    protected $dates = ['last_activity']; # Users last activity

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', # User Email
        'username', # User username
        'first_name', # User first name
        'last_name', # User last name
        'password', # User password(hashed through bcrypt)
        'location', # User location
        'biography', # User biography
        'sex', # User sex
        'position', # User staff position
        'last_activity', # Users last activity
        'ip', # User IP
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', # User password
        'remember_token', # User remember me token
        'ip', # User IP
    ];

    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}"; # Return the users first and last name if they are not null
        }

        if ($this->first_name) {
            return $this->first_name; # Return the first name if the last name is not specified
        }

        return null; # Return NULL if nothing neither the Users first or last name was defined
    }

    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username; # Get the Users First and last name by calling the function getName() or return the username if there is no first or last name specified
    }

    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username; # Get the Users First name or the Users username if the First name is not defined
    }

    public function getAvatarUrl($size = 45)
    {
        return "http://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm&s=" . $size; # Get the Users gravatar profile image URL by getting the Users email and MD5 hashing it
    }

    public function statuses()
    {
        return $this->hasMany('ConnectU\Models\Status', 'user_id'); # Get the Users statuses by their ID
    }

    public function likes()
    {
        return $this->hasMany('ConnectU\Models\Like', 'user_id'); # Get the Users likes by their ID
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('ConnectU\Models\User', 'friends', 'user_id', 'friend_id'); # Get the friends of the user
    }

    public function friendsOf()
    {
        return $this->belongsToMany('ConnectU\Models\User', 'friends', 'friend_id', 'user_id'); # Get the Friends of a certain user
    }

    public function friends()
    {
        # Get the Users friends
        return $this
            ->friendsOfMine()
            ->wherePivot('accepted', true)
            ->get()
            ->merge($this->friendOf()
            ->where('accepted', true)
            ->get())
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get(); # Get the users friends requests to them
    }

    public function friendRequestsPending()
    {
        return $this->friendsOf()->wherePivot('accepted', false)->get(); # The Users friend requests to a nother person
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count(); # Check if the User has a friend request pending
    }

    public function hasFriendRequestReveived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count(); # Check if the User has received a friend request
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id); # Add a friendship between the current user and the $user
    }

    public function removeFriend(User $user)
    {
        if (!Auth::user()->isFriendsWith($user)) {
            # Check to see if the current user is actually friends with $user
            return redirect()->back()->with('dang', 'You are not friends with' . $user->getFirstNameOrUsername());
        }

        if (!$user) {
            # Check to see if a user is passed
            return redirect()->back()->with('dang', 'That is not a real user!');
        }

        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        # Accept the pending friend request(update accepted to true)
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
        ]);
    }

    public function isFriendsWith(User $user)
    {
        # Check to see if the current user is friends with $user
        return (bool) $this>friends()->where('id', $user->id)->count()
    }

    public function hasLikedStatus(Status $status)
    {
        # Check to see if the current user has already liked a status
        return (bool) $status->likes()->where('user_id', $this->id)->count();
    }

    public function isAdmin(User $User)
    {
        # Check to see is the $user is an admin
        if ($user->position === 'admin') {
            return true;
        }

        return false;
    }

    public function isMod(User $user)
    {
        # Check to see if the $user is a moderator
        if ($user->position === 'mod') {
            return true;
        }

        return false;
    }

    public function isHelper(User $user)
    {
        # Check to see if the $user is a helper
        if ($user->position === 'helper') {
            return true;
        }

        return false;
    }

    public function isStaff(User $user)
    {
        # Check to see if the $user is staff
        if ($user->position !== NULL || $user->position !== "") {
            return true;
        }

        return false;
    }

    public function isModAndUp(User $user)
    {
        # Check to see if $user is a moderator or an administrator
        if ($user->position === 'mod' || $user->position === 'admin') {
            return true;
        }

        return false;
    }

    public function reloadActivityTime()
    {
        # Get the current time and set it to $current_time
        $current_time = Carbon::now()->subHours(5);

        $this->update([
            'last_activity' => $current_time,
        ]);
    }
}
