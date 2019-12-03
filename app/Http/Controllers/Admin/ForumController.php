<?php

namespace App\Http\Controllers\Admin;

use App\Models\Forum;
use Illuminate\Http\Request;
use App\Models\CategoryForum;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\ForumRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
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
        $topics = Forum::with(['category'])->paginate(6);
        return view('admin.forum.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topic = new Forum;
        $categories = CategoryForum::all();
        return view('admin.forum.create', compact('categories','topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request)
    {
        //dd($request);
        $topic = new Forum;
        $topic->create($request->only('title','topic','category_forum_id')); 

        Flashy::message("Le sujet a été crée avec succes");
        return redirect()->route('admin.forum.index');
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
    public function edit(Forum $topic)
    {
        $categories = CategoryForum::all();
        return view('admin.forum.edit', compact('topic','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumRequest $request,Forum $topic)
    {
        
        $data = [
            'title' => $request->title,
            'topic' => $request->topic,
            'category_forum_id' => $request->category_forum_id,
        ];
        // dd($data);
        $topic->update($data);
    
        Flashy::message("Le sujet a été modifié avec succes");
        return redirect()->route('admin.forum.index');
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

    public function category() 
    {
        $categories = CategoryForum::all();
        return view('admin.forum.categories', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3'
        ]);
        
        $category = new CategoryForum;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.forum.categories');
    }

    public function categoryEdit(CategoryForum $category)
    {
        return view('admin.forum.categoriesEdit', compact('category'));
    }

    public function categoryUpdate(Request $request, CategoryForum $category)
    {
        $this->validate($request,[
            'name' => 'required|min:3'
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        return redirect()->route('admin.forum.categories');
    }

    public function categoryDelete(CategoryForum $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
