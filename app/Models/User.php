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
    protected $dates = ['last_activity'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'first_name',
        'last_name',
        'password',
        'location',
        'biography',
        'sex',
        'position',
        'last_activity',
        'ip',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'ip',
    ];


    /**
     * Get the users name.
     *
     * Firsts checks if both the users first and last name is defined
     * Then checks if just the first name is defined
     *
     * @return string
     */
    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    /**
     * Gets the users full name or username
     *
     * Uses the getName() function. If nothing is returned from that
     * Get the users username
     *
     * @return string
     */
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    /**
     * Gets the users first name or username
     *
     * @return string
     */
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;

    /**
     * Grabs the users gravatar image
     *
     * Uses the md5 hash of the users email and uses the size specified
     * To generate the profile image
     *
     * @param int $size
     * @return string
     */
    public function getAvatarUrl($size = 45)
    {
        return "http://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm&s=" . $size;
    }

    /**
     * Gets the users statuses
     *
     * Uses a hasMany relationship to see the users statuses by the user_id
     *
     * @return void
     */
    public function statuses()
    {
        return $this->hasMany('ConnectU\Models\Status', 'user_id');
    }

    /**
     * Gets the users likes
     *
     * Uses a hasMany relationship to see the users likes by the user_id
     *
     * @return void
     */
    public function likes()
    {
        return $this->hasMany('ConnectU\Models\Like', 'user_id');
    }

    /**
     * Gets the friends of the user
     *
     * Uses a belongsToMany relationship to determine what users are friends with the user
     *
     * @return void
     */
    public function friendsOfMine()
    {
        return $this->belongsToMany('ConnectU\Models\User', 'friends', 'user_id', 'friend_id');
    }

    /**
     * Gets the friends of other users. Reversed of friendsOfMine()
     *
     * Uses a belongsToMany relationship to determine what users are friends with a user
     *
     * @return void
     */
    public function friendsOf()
    {
        return $this->belongsToMany('ConnectU\Models\User', 'friends', 'friend_id', 'user_id');
    }

    /**
     * Gets the friendship between two users
     *
     * Uses the friendsOfMine() pivot where 'accepted' is true and gets the results.
     * Also, this merges the friendsOf() function too so you get both friendships you
     * have initiated and a different user has initiated.
     *
     * @return array
     */
    public function friends()
    {
        return $this
            ->friendsOfMine()
            ->wherePivot('accepted', true)
            ->get()
            ->merge($this->friendsOf()
            ->where('accepted', true)
            ->get());
    }

    /**
     * Grabs the users friend requests
     *
     * Uses the friendsOfMine() to determine if we have any friend requests pending.
     * We use friendsOfMine() because that is logic for when a DIFFERENT user(not the logged in user)
     * Initiates a friendship instance
     *
     * @return array
     */
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    /**
     * Grabs the users pending friend requests
     *
     * Uses the friendsOf() to determine the friendships that we have for other users
     * that are still pending, not accepted. We use friendsOf() because it shows
     * friendship instances where we initiated it.
     *
     * @return array
     */
    public function friendRequestsPending()
    {
        return $this->friendsOf()->wherePivot('accepted', false)->get();
    }
    /**
     * Checks to see if a specified user has any friend requests pending
     *
     * Using the count of friendRequestsPending(), where the users id is present, if it
     * is 1, then it returns true, else returns false
     *
     * @return boolean
     */
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    /**
     * Checks to see if a specified user has any friend requests recieved
     *
     * Using the count of friendRequestsPending(), where the users id is present, if it
     * is 1, then it returns true, else returns false
     *
     * @return boolean
     */
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendsOf()->attach($user->id);
    }

    public function removeFriend(User $user)
    {
        if (!Auth::user()->isFriendsWith($user)) {
            return redirect()->back()->with('dang', 'You are not friends with' . $user->getFirstNameOrUsername());
        }

        if (!$user) {
            return redirect()->back()->with('dang', 'That is not a real user!');
        }

        $this->friendsOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
        ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes()->where('user_id', $this->id)->count();
    }

    public function getAdminAttribute()
    {
        return $this->position === 'admin';
    }

    public function hasPosition($position = null)
    {
        $position = is_array($position) ? $position : func_get_args();

        return in_array($this->position, $position);

        // EXAMPLE USE:
        // $user->hasPosition('mod');
    }

    public function reloadActivityTime()
    {
        $current_time = Carbon::now()->subHours(5);

        $this->update([
            'last_activity' => $current_time,
        ]);
    }
}
