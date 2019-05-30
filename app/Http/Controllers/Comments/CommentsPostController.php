<?php

namespace App\Http\Controllers\Comments;

use Flashy;
use App\Models\Post;
use App\Models\CommentsPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentsPostRequest;

class CommentsPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentsPostRequest $comment,Post $post)
    {
        // $com = ['comment'=>$comment->comment];
        $com = new CommentsPost;
        // $com->user_id = $comment->user()->id;
        $com->post_id = $post->id;
        $com->comment = $comment->comment;
        // $post->comments()->save($com);
        Auth::user()->comments()->save($com);
      
        Flashy::message("Merci de votre commentaire");
        return redirect()->route('blog.show',$post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, CommentsPost $comment)
    {
        $comment->delete();
        Flashy::error("Le commentaire a été supprimé");
        return redirect()->route('blog.show',$post->slug);
    }
}
