<?php

namespace App\Providers;

use App\Comment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('canReply',function ($attribut,$value,$params){
            if(!$value){
                return true;
            }
            $comment = Comment::find($value);
            if($comment){
                return $comment->reply == 0;
            }
            return false;
        });
    }
}
