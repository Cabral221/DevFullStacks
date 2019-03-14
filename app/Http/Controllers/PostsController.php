<?php

namespace App\Http\Controllers;

use Flashy;
use App\Models\Post;
use App\User;
use App\Models\CommentsPost;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except'=> ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->role){
            Flashy::error("Vous etes pas autorisé à effectuer cette action");
            return redirect()->route('blog.index');
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = ['title' => $request->title,'body'  => $request->body];

        auth()->user()->posts()->create($data); 

        Flashy::message("L'article a été crée avec succes");
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $comments = CommentsPost::with('user')->where(['post_id'=>$post->id])
                                ->orderBy('created_at', 'desc')->paginate(5);  
        return view('posts.show',['post'=>$post,'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!auth()->user()->role){
            Flashy::error("Vous etes pas autorisé à effectuer cette action");
            return redirect()->route('blog.index');
        }
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'body'  => $request->body,
        ]);
        Flashy::message("L'article a été modifié avec succes");
        return redirect()->route('blog.show',$post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(!auth()->user()->role){
            Flashy::error("Vous etes pas autorisé à effectuer cette action");
            return redirect()->route('blog.index');
        }
        $post->delete();
        Flashy::error("L'article a été supprimé");
        return redirect()->route('blog.index');
    }
}