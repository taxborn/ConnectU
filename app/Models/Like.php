<?php

namespace ConnectU\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'likeable';

    /**
     * Morphs something to be likeable
     *
     * @return void
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    /**
     * Makes sure that a user is making a like instance
     *
     * @return none
     */
    public function user()
    {
        return $this->belongsTo('ConnectU\Models\User', 'user_id');
    }
}
