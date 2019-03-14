<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentsPost extends Model
{
    
    protected $fillable = ['comment','post_id'];


    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    /**
     * Get the user that owns the comment
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault(['user_id'=>auth()->user()]);
    }

}
