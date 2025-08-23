<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Event;

class ReviewDecisionNotification extends Notification
{
    protected $submission;
    protected $review;

    public function __construct($submission, $review)
    {
        $this->submission = $submission;
        $this->review = $review;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        // Convert evaluation to readable form
        $decision = match ($this->review->evaluation) {
            'acceptable' => 'accepted ✅',
            'minor_revisions', 'major_revisions' => 'conditionally accepted (needs revision). This submission has been auto-rejected
                                        after 3 revisions.✏️',
            'reject' => 'rejected ❌',
            'published' => 'published ✅',
        };
        $event = Event::find($this->submission->event_id);
        $cleaned = preg_replace('/\[\d+\]/', '.', $this->review->reviewer_comments);

        $categoryName = $this->submission->category->name ?? 'Submission';
        if ($this->review->evaluation == 'acceptable')
            return [
                'title' => 'Review Result for Your Paper',
                'message' => 'Your ' . $categoryName . ' paper has been ' . $decision . '.',
                'evaluation' => $this->review->evaluation,
                'review_id' => $this->review->id,
                'submission_id' => $this->submission->id,
                'category' => $categoryName,
                'type' => 'review_decision',
            ];
        elseif ($this->review->evaluation == 'reject') {
            return [
                'title' => 'Review Result for Your Paper',
                'message' => 'Your ' . $categoryName . ' paper has been ' . $decision . '.'. $cleaned . '.',
                'evaluation' => $this->review->evaluation,
                'review_id' => $this->review->id,
                'submission_id' => $this->submission->id,
                'category' => $categoryName,
                'type' => 'review_decision',
            ];
        }
        elseif ($this->review->evaluation == 'published') {
            return [
                'title' => 'Review Result for Your Paper',
                'message' => 'Your ' . $categoryName . ' paper has been ' . $decision . '.',
                'evaluation' => $this->review->evaluation,
                'review_id' => $this->review->id,
                'submission_id' => $this->submission->id,
                'category' => $categoryName,
                'type' => 'review_decision',
            ];
        }
        elseif ($this->review->evaluation == 'minor_revisions' || $this->review->evaluation == 'major_revisions') {
            return [
                'title' => 'Review Result for Your Paper',
                'message' => 'Your ' . $categoryName . ' paper has been ' . $decision . '.Your paper need
                 ' . $cleaned . '. Your Paper is update two week before ' . $event->acceptance_date . '.',
                'evaluation' => $this->review->evaluation,
                'review_id' => $this->review->id,
                'submission_id' => $this->submission->id,
                'category' => $categoryName,
                'type' => 'review_decision',
            ];
        }
    }
}
