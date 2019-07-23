<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd('lol');
        $posts = Auth::user()->posts()->with(['category','likes'])->paginate(6);
        // dd($posts);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('posts.create')){
            $post = new Post();
            $categories = Category::all('name','id');
    
            return view('admin.posts.create',compact('post','categories'));
        }
        return view('errors.403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $filename = null;
        if($request->hasFile('image')){
            $filename = $request->image->store('public/posts/head-bg');
        }
        $data = [
            'title' => $request->title,
            'introduce' => $request->introduce,
            'body'  => $request->body,
            'online' => $request->online,
            'category_id' => $request->category_id,
            'image' => $filename,
        ];

        auth()->user()->posts()->create($data); 

        Flashy::message("L'article a été crée avec succes");
        return redirect()->route('admin.blog.index');
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Auth::user()->can('posts.update')){
            $categories = Category::all('name','id');
            return view('admin.posts.edit',compact('post','categories'));
        }
        return view('errors.403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request,Post $post)
    {
        $filename = null;
        if($request->hasFile('image')){
            $filename = $request->image->store('public/posts/head-bg');
        }
        $data = [
            'title' => $request->title,
            'introduce' => $request->introduce,
            'image' => $filename,
            'body'  => $request->body,
            'online' => $request->online,
            'category_id' => $request->category_id,
        ];
        // dd($data);
        $post->update($data);
    
        Flashy::message("L'article a été modifié avec succes");
        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Flashy::error("L'article a été supprimé");
        return redirect()->back();
    }

    
    public function update_avatar(Request $request)
    {
        
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(\public_path('/uploads/avatars/' . $filename));
            Auth::user()->avatar = $filename;
            Auth::user()->save(); 
        }
        return redirect()->back();
    }



    public function category ()
    {
        if(Auth::user()->can('posts.category')){
            $categories = Category::all();
            return view('admin.posts.categories',compact('categories'));
        }
        return view('errors.403');
    }

    public function categoryStore(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
        ]);
        $filename = false;
        if($request->hasFile('image')){
            $filename = $request->image->store('public/posts/categories');
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->image = $filename;
        $category->save();

        Flashy::message("Catégorie ajoutée");
        return redirect()->route('admin.blog.categories');
        
    }

    public function categoryEdit (Category $category)
    {
        // dd($category);
        if(Auth::user()->can('posts.category')){
            return view('admin.posts.categoriesEdit',compact('category'));
        }
        return view('errors.403');
    }

    public function categoryUpdate (Request $request, Category $category)
    {
        // dd($category);
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
        ]);
        $filename = false;
        if($request->hasFile('image')){
            $filename = $request->image->store('public/posts/categories');
        }
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->image = $filename;
        // dd($request->all());
        $category->save();
        return  redirect()->route('admin.blog.categories');
        // A continuere ici     
    }
    
    public function categoryDestroy (Category $category)
    {
        $category->delete();

        Flashy::error("a catégorie a été supprimé");
        return redirect()->back();
    }

    public function comment ()
    {
        return view('admin.posts.comments');
    }
}
