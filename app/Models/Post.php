<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','body'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function($post){
            $post->slug = Str::slug($post->title);
        });
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\CommentsPost');
    }

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\PostsLikes');
    }

    /**
     * Permet de savoir si l'utilisateur a liker cette article
     *
     * @param User $user
     * @return boolean
     */
    public function isLikeByUser(User $user) : bool
    {
        foreach ($this->likes as $like ) {
            // dd($user->id);
            // dd($like->user_id);
            if($like->user_id == $user->id) return true;
        }
        return false;
    }

}
