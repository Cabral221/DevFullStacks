<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name','slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($role){
            $role->slug = Str::slug($role->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
}
