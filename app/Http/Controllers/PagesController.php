<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $posts = Post::with('category')->published()->orderBy('created_at', 'desc')->limit(3)->get();  
        return view('pages.home',compact('posts'));
    }

    public function about(){
        return view('pages.about');
    }

}
