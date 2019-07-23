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

    public function allFor($id)
    {
        $records = self::where(['post_id' => $id])->orderBy('created_at','ASC')->get();
        $comments = [];
        $by_id = [];
        foreach ($records as $record){
            if($record->reply){
                $by_id[$record->reply]->attributes['replies'][] = $record;
            }else{
                $record->attributes['replies'] = [];
                $by_id[$record->id] = $record;
                $comments[] = $record; 
            }
        }
        return $comments;
    }

}
