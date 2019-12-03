<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['topic','title','category_forum_id'];

    public static function boot()
    {
        parent::boot();
        static::creating(function($topic){
            $topic->slug = Str::slug($topic->title);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setStat()
    {
        // dd($this->stat);
        if($this->stat == 1){
            return true;
        }
        return false;
    }


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

    public function category(){
        return $this->belongsTo('App\Models\CategoryForum','id');
    }
}
