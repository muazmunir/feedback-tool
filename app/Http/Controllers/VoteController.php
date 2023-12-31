<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Vote;
class VoteController extends Controller
{
    public function upvote(Feedback $feedback)
    {
        $user = auth()->user();
        $existingVote = Vote::where('user_id', $user->id)
                        ->where('feedback_id', $feedback->id)
                        ->first();
        if ($existingVote) {
            return response()->json(['message' => 'You have already voted on this feedback.','code' => 403]);
        }
        $vote = new Vote();
        $vote->user_id = $user->id;
        $vote->feedback_id = $feedback->id;
        $vote->vote = 1;
        $vote->save();
        $feedback->increment('vote_count');
        return response()->json(['message' => 'Upvoted successfully']);
    }

    public function downvote(Feedback $feedback)
    {
        $user = auth()->user();
        $existingVote = Vote::where('user_id', $user->id)
                        ->where('feedback_id', $feedback->id)
                        ->first();
        if ($existingVote) {
            return response()->json(['message' => 'You have already voted on this feedback.','code' => 403]);
        }
        $vote = new Vote();
        $vote->user_id = $user->id;
        $vote->feedback_id = $feedback->id;
        $vote->vote = -1;
        $vote->save();
        $feedback->decrement('vote_count');
        return response()->json(['message' => 'Downvoted successfully']);
    }
}
