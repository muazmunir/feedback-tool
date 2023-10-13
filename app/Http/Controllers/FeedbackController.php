<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function showFeedbackForm()
    {
        return view('feedback-form');
    }

    public function storeFeedback(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:bug,feature,improvement',
            'description' => 'required|string',
        ]);

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
        $feedbackItems = Feedback::with('user')->paginate(2);
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
}
