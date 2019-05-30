<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PostsLikes extends Model
{
    //



    /**
     * Get the post that owns the likes.
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * Get the user that owns the likes
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault(['user_id'=>auth()->user()]);
    }
}
