<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($feedback)
    {
        $feedback = Feedback::where('slug',$feedback)->first();
        $comments = Comment::where('feedback_id',$feedback->id)->latest()->get();
        return view('comments', ['comments' => $comments]);
    }


    public function store(Request $request)
    {
        $feedback = Feedback::where('slug',$request->slug)->first();
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->id();
        $comment->feedback_id = $feedback->id;
        $comment->save();

        return response()->json(['message' => 'Comment saved successfully']);
    }

}
