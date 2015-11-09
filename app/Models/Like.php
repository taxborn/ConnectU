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

    public function likeable()
    {
        # Make something likeable
        return $this->morphTo();
    }

    public function user()
    {
        # Make sure that a USER is making the like instance
        return $this->belongsTo('ConnectU\Models\User', 'user_id');
    }
}
