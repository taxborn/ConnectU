<?php

namespace ConnectU;

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
        return $this->hasMany('ConnectU\Models\Status', 'user_id');
    }
}
