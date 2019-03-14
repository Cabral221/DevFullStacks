<?php

namespace App\Http\Controllers;

use Flashy;
use App\User;
use App\Models\Forum;
use App\Models\CommentsForum;
use Illuminate\Http\Request;
use App\Http\Requests\ForumRequest;

class ForumsController extends Controller
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
        $topics = Forum::with('user')->orderBy('created_at', 'desc')->paginate(5);   
        return view('forum.index',compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request)
    {
        $topic = new Forum;
        $topic->topic = $request->topic;
        auth()->user()->forums()->save($topic); 

        Flashy::message("Le sujet a été crée avec succes");
        return redirect()->route('forum.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $topic)
    {
        $comments = CommentsForum::with('user')->where(['forum_id'=>$topic->id])
                                   ->orderBy('created_at', 'desc')->paginate(5);  
        return view('forum.show',compact('topic','comments'));
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
    public function destroy($id)
    {
        //
    }
}
