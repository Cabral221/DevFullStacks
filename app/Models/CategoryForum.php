<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class CategoryForum extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::creating(function($category){
            $category->slug = Str::slug($category->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function topics(){
        return $this->hasMany('App\Models\Forum','id')->orderBy('created_at','DESC');
    }
}
