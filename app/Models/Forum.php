<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['topic'];


    /**
     * Get the comments for the topic forum.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\CommentsForum');
    }

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
