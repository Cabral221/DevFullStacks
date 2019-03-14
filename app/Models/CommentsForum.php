<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentsForum extends Model
{
    protected $fillable = ['topic'];


    /**
     * Get the post that owns the comment.
     */
    public function forum()
    {
        return $this->belongsTo('App\Models\Forum');
    }

    /**
     * Get the user that owns the comment
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault(['user_id'=>auth()->user()]);
    }
}
