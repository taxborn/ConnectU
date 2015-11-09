<?php

namespace ConnectU\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', # Status Body
    ];

    public function user()
    {
        # Make sure that it is a user posting a status
        return $this->belongsTo('ConnectU\Models\User', 'user_id');
    }

    public function scopeNotReply($query)
    {
        # If the user is a moderator or an administrator, show ALL statuses even deleted ones
        if (Auth::user()->isModAndUp(Auth::user())) {
            return $query->whereNull('parent_id');
        }

        # Else, show statuses that are not deleted
        return $query->whereNull('parent_id')->where('deleted', 0);
    }

    public function replies()
    {
        # If the user is a moderator or an administrator, show ALL replies even deleted ones
        if (Auth::user()->isModAndUp(Auth::user())) {
            return $this->hasMany('ConnectU\Models\Status', 'parent_id')
        }

        # Else, show replies that are not deleted
        return $this->hasMany('ConnectU\Models\Status', 'parent_id')->where('deleted', 0);
    }

    public function likes()
    {
        # Get the likes from a status
        return this->morphMany('ConnectU\Models\Like', 'likeable');
    }
}
