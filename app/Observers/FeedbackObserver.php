<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Feedback;

class FeedbackObserver
{
    public function creating(Feedback $feedback): void
    {
        $this->generateUniqueSlug($feedback);
    }

    private function generateUniqueSlug(Feedback $feedback): void
    {
        $slug = Str::slug($feedback->title);
        $existingFeedback = Feedback::where('slug', $slug)
            ->where('id', '!=', $feedback->id)
            ->first();
        if ($existingFeedback) {
            $suffix = 1;
            while (Feedback::where('slug', "{$slug}-{$suffix}")
                ->where('id', '!=', $feedback->id)
                ->exists()) {
                $suffix++;
            }
            $slug = "{$slug}-{$suffix}";
        }
        $feedback->slug = $slug;
    }
}
