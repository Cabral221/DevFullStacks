<?php

namespace App\Http\Controllers;

use Flashy;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostsLikes;
use App\User;
use App\Models\CommentsPost;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

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
        $posts = Post::with('category')->published()->orderBy('created_at', 'desc')->paginate(6);
        //  dd(auth()->user());
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
        $post = new Post();
        $categories = Category::all('name','id');

        return view('posts.create',compact('post','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = [
            'title' => $request->title,
            'introduce' => $request->introduce,
            'body'  => $request->body,
            'online' => $request->online,
        ];

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
        // dd($post->published());
        
        if(!$post->published()){            
            return redirect()->route('blog.index');
        }
        $comments = CommentsPost::with('user')->where(['post_id'=>$post->id])->orderBy('created_at', 'desc')->paginate(5);
        // dd($nbComments);
        return view('posts.show',[
            'post'=>$post,
            'comments'=>$comments
        ]);
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
        $categories = Category::all('name','id');
        // foreach ($categories as $key => $value) {
        //     // dd($value->id);
        //     }
        return view('posts.edit',compact('post','categories'));
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
        // dd($request->online);
        $post->update([
            'title' => $request->title,
            'introduce' => $request->introduce,
            'body'  => $request->body,
            'online' => $request->online,
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


    public function like(Post $post)
    {
        $user =  auth()->user();
        if(!$user){
            dd($user);
            return response([
                'code' => 401,
                'message' => "vous n'est pas autorisé à effectuer cette action"
            ],401);
        }
        if($post->isLikeByUser($user)){
            $like = PostsLikes::with('user')->where(['post_id'=>$post->id]);
            $like->delete();
            // dd($like);
            
            return response([
                'code' => 200,
                'message' => 'Like bien supprimer',
                'likes' => PostsLikes::where(['post_id' => $post->id])->count(),
            ], 200);
        }
        
        $like = new PostsLikes();
        $like->user_id = auth()->user()->id;
        $like->post_id = $post->id;
        // dd($like);
        $like->save();
        return response([
            'code' => 200,
            'message' => 'like bien ajouter',
            'likes' => PostsLikes::where(['post_id' => $post->id])->count(),
        ],200);
    }
}