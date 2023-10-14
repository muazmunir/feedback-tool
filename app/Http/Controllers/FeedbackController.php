<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function showFeedbackForm()
    {
        return view('feedback-form');
    }

    public function store(FeedbackRequest $request)
    {
        Feedback::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('feedback.form')->with('success', 'Feedback submitted successfully!');
    }

    public function feedbacks()
    {
        $feedbackItems = Feedback::with('user')->paginate(5);
        return view('feedbacks' ,compact('feedbackItems'));
    }

    public function getfeedback($slug)
    {
        $feedback = Feedback::where('slug',$slug)->first();
        if($feedback){
            return view('feedback' ,compact('feedback'));
        }
        return redirect()->route('feedback.all');
    }

    public function getVoteCount($feedbackId)
    {
        $Feedback = Feedback::find($feedbackId);
        return response()->json(['vote_count' => $Feedback->vote_count]);
    }

}
