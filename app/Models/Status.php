<?php

namespace ConnectU\Models;

use Auth;
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
        'body',
    ];

    /**
     * Gets the user that the status belongs to
     *
     * Uses a belongsTo relationship to determine what user the status belongs To
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('ConnectU\Models\User', 'user_id');
    }

    /**
     * Gets every status that is not a reply
     *
     * Checks to see that the 'parent_id' is NULL (That means that it is not a reply)
     *
     * @return void
     */
    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Gets all statuses that are replies
     *
     * Gets the statuses that are replies and that parent_id is not NULL using
     * a hasMany relationship
     *
     * @return void
     */
    public function replies()
    {
        return $this->hasMany('ConnectU\Models\Status', 'parent_id');
    }

    /**
     * Gets the likes of a status
     *
     * Uses a morphMany polymorph to determine what likes that is attached to the
     * Status.
     *
     * @return void
     */
    public function likes()
    {
        return $this->morphMany('ConnectU\Models\Like', 'likeable');
    }
}
