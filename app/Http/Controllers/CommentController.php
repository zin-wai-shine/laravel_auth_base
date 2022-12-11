<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::latest('id')->paginate(10)->withQueryString();
        return CommentResource::collection($comments);
    }


    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->description = $request->description;
        $comment->user_id = Auth::id();
        $comment->product_id = $request->product_id;
        $comment->save();

        return response()->json(['success'=>true, 'message'=>'you was created', 'data' => new CommentResource($comment)]);
    }


    public function show(Comment $id)
    {
        $comment = Comment::find($id);
        return response()->json($comment);

        if(is_null($comment)){
            return response()->json(['message'=>'comment not found']);
        }

        return new CommentResource($comment);
    }



    public function destroy(Comment $id)
    {
        $comment = Comment::find($id);
        if(is_null($comment)){
            return response()->json(['message'=>'comment not found']);
        }
        $comment->delete();

        return response()->json(['message'=>'comment was removed'], 200);

    }
}
