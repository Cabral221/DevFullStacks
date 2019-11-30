<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $posts = Post::with('category')->published()->orderBy('created_at', 'desc')->limit(3)->get();
        $topics = Forum::orderBy('created_at','desc')->limit(4)->get();
        return view('pages.home',compact('posts','topics'));
    }

    public function about(){
        return view('pages.about');
    }

}
