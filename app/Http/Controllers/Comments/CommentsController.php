<?php

namespace App\Http\Controllers\Comments;

use App\Comment;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreCommentRequest;

class CommentsController extends Controller
{
    public function index ()
    {
        // sleep(3);
        // Comment::isCommentable('Post',100);
        // return Response::json(Input::get('type'),200,[],JSON_NUMERIC_CHECK);
        $comments = Comment::allFor(Input::get('type'),Input::get('id'));
        return Response::json($comments,200,[],JSON_NUMERIC_CHECK);
    }

    public function store(StoreCommentRequest $request)
    {
        $model = Input::get('commentable_type');
        $id = Input::get('commentable_id');
        if(Comment::isCommentable($model,$id)){
            $comment = Comment::create([
                'commentable_id' => $id,
                'commentable_type' => $model,
                'content' => Input::get('content'),
                'email' => Input::get('email'),
                'username' => Input::get('username'),
                'reply' => Input::get('reply',0),
                'ip' => $request->ip(),
            ]);
            return Response::json($comment,200,[],JSON_NUMERIC_CHECK);
        }else{
            return Response::json('Ce contenu n est pas commentable',422);
        }

    }



    public function destroy($id)
    {
        $comment = Comment::find($id);

        if($comment->ip == Request::ip()){
            Comment::where('reply',$comment->id)->delete();
            $comment->delete();
            return Response::json($comment,200,[],JSON_NUMERIC_CHECK);
        }else{
            return Response::json('Ce commentraire ne vous appartienne pas',403);
        }
    }
}
