<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\Conference;
use Illuminate\Http\Request;
use App\Models\JournalSubmission;
use App\Models\ReviewConferenceSchedule;
use App\Models\ReviewJournalSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ConferenceSubmission;
use App\Models\JournalReview;
use App\Models\ConferenceReview;

class ReviewerResponseController extends Controller
{

    public function downloadConferenceReviewPaper($id)
    {
        $schedule = ReviewConferenceSchedule::with('conferenceSubmission')->findOrFail($id);
        $path = $schedule->conferenceSubmission->paper_path;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($path);
    }
    public function downloadJournalReviewPaper($id)
    {
        $schedule = ReviewJournalSchedule::with('conferenceSubmission')->findOrFail($id);
        $path = $schedule->journalSubmission->paper_path;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($path);
    }

    public function updateConference(Request $request, $id)
    {
        $request->validate([
            'evaluation' => 'required|in:acceptable,minor_revisions,major_revisions,reject',
            'reviewer_comments' => 'required|string|min:10',
        ]);

        $review = ConferenceReview::where('conference_submission_id', $id)->first();

        if (!$review) {
            // Create new review row with current user as reviewer1
            $review = ConferenceReview::create([
                'conference_submission_id' => $id,
                'reviewer1_id' => Auth::id(),
                'evaluation' => $request->evaluation, // initial, may be overwritten
                'reviewer_comments' => $request->reviewer_comments,
                'status' => 'draft',
            ]);
        } else {
            $userId = Auth::id();
            $evaluationChanged = false;

            if ($review->reviewer1_id === null) {
                $review->reviewer1_id = $userId;
                $evaluationChanged = true;
            } elseif ($review->reviewer2_id === null) {
                $review->reviewer2_id = $userId;
                $evaluationChanged = true;
            } elseif ($review->reviewer3_id === null) {
                $review->reviewer3_id = $userId;
                $evaluationChanged = true;
            } else {
                return back()->with('error', 'All reviewers already assigned.');
            }

            if ($evaluationChanged) {
                // Append new reviewer comment
                $review->reviewer_comments .= "\n[{$userId}] " . $request->reviewer_comments;

                // Store the current user's evaluation separately
                // We simulate storing multiple reviewer decisions in this array
                $evaluations = [];

                // Existing evaluation already stored
                if (!empty($review->evaluation)) {
                    $evaluations[] = $review->evaluation;
                }

                // Add the new evaluation just submitted
                $evaluations[] = $request->evaluation;

                // Normalize to collection
                $evalCollection = collect($evaluations)->filter();

                // Final decision logic:
                if ($evalCollection->contains('reject')) {
                    $review->evaluation = 'reject';
                } elseif (
                    $evalCollection->count() === 3 &&
                    $evalCollection->every(fn($e) => $e === 'accept')
                ) {
                    $review->evaluation = 'accept';
                } elseif ($evalCollection->count() >= 2) {
                    // Use majority vote
                    $frequencies = $evalCollection->countBy();
                    $review->evaluation = $frequencies->sortDesc()->keys()->first(); // most frequent value
                } else {
                    $review->evaluation = $request->evaluation; // fallback
                }

                $review->save();
            }
        }

        return redirect()->back()->with('success', 'Conference review submitted successfully.');
    }

    public function updateJournal(Request $request, $id)
    {
        $request->validate([
            'evaluation' => 'required|in:acceptable,minor_revisions,major_revisions,reject',
            'reviewer_comments' => 'required|string|min:10',
        ]);

        $review = JournalReview::where('journal_submission_id', $id)->first();

        if (!$review) {
            // Create new review row with current user as reviewer1
            $review = JournalReview::create([
                'journal_submission_id' => $id,
                'reviewer1_id' => Auth::id(),
                'evaluation' => $request->evaluation, // initial, may be overwritten
                'reviewer_comments' => $request->reviewer_comments,
                'status' => 'draft',
            ]);
        } else {
            $userId = Auth::id();
            $evaluationChanged = false;

            if ($review->reviewer1_id === null) {
                $review->reviewer1_id = $userId;
                $evaluationChanged = true;
            } elseif ($review->reviewer2_id === null) {
                $review->reviewer2_id = $userId;
                $evaluationChanged = true;
            } elseif ($review->reviewer3_id === null) {
                $review->reviewer3_id = $userId;
                $evaluationChanged = true;
            } else {
                return back()->with('error', 'All reviewers already assigned.');
            }

            if ($evaluationChanged) {
                // Append new reviewer comment
                $review->reviewer_comments .= "\n[{$userId}] " . $request->reviewer_comments;

                // Store the current user's evaluation separately
                // We simulate storing multiple reviewer decisions in this array
                $evaluations = [];

                // Existing evaluation already stored
                if (!empty($review->evaluation)) {
                    $evaluations[] = $review->evaluation;
                }

                // Add the new evaluation just submitted
                $evaluations[] = $request->evaluation;

                // Normalize to collection
                $evalCollection = collect($evaluations)->filter();

                // Final decision logic:
                if ($evalCollection->contains('reject')) {
                    $review->evaluation = 'reject';
                } elseif (
                    $evalCollection->count() === 3 &&
                    $evalCollection->every(fn($e) => $e === 'accept')
                ) {
                    $review->evaluation = 'accept';
                } elseif ($evalCollection->count() >= 2) {
                    // Use majority vote
                    $frequencies = $evalCollection->countBy();
                    $review->evaluation = $frequencies->sortDesc()->keys()->first(); // most frequent value
                } else {
                    $review->evaluation = $request->evaluation; // fallback
                }

                $review->save();
            }
        }

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }
}