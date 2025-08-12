<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\ReviewDecisionNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConferenceSubmission;
use App\Models\User;
use App\Models\ConferenceReview;
use App\Models\ReviewConferenceSchedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ReviewConferenceScheduleController extends Controller
{
    public function viewconferenceschedule(Request $request)
    {
        $schedules = ReviewConferenceSchedule::all();
        return view('admin.reviewer.viewconferenceschedule', compact('schedules'));
    }
    public function conferenceschedule(Request $request)
    {
        $topicId = $request->input('topic_id'); // Selected topic ID

        // Get all papers with topics loaded
        $allPapers = ConferenceSubmission::with('topics')->get();

        // Extract unique topic models from all papers
        $topics = $allPapers->pluck('topics')->unique('id')->values();

        $papers = collect();
        $reviewers = collect();

        if ($topicId) {
            // 1. Filter papers that match the selected topic and have a valid file
            $papers = ConferenceSubmission::where('topic_id', $topicId)
                ->whereNotNull('paper_path')
                ->where('paper_path', '<>', '')
                ->whereDoesntHave('reviewSchedule') // ensure no record in review table
                ->get();


            // 2. Get the selected topic name
            $selectedTopicName = optional(\App\Models\Topic::find($topicId))->name;

            // 3. Filter reviewers by field containing the topic name and not scheduled more than 3 times
            $reviewers = User::whereHas('roles', function ($query) {
                $query->where('name', 'reviewer');
            })
                ->whereRaw("FIND_IN_SET(?, field)", [$selectedTopicName])
                ->whereNotIn('id', function ($query) {
                    $query->select('reviewer_id')
                        ->from(DB::raw('(
                SELECT reviewer1_id AS reviewer_id FROM review_journal_schedules WHERE reviewer1_id IS NOT NULL
                UNION ALL
                SELECT reviewer2_id FROM review_journal_schedules WHERE reviewer2_id IS NOT NULL
                UNION ALL
                SELECT reviewer3_id FROM review_journal_schedules WHERE reviewer3_id IS NOT NULL
                UNION ALL
                SELECT reviewer1_id FROM review_conference_schedules WHERE reviewer1_id IS NOT NULL
                UNION ALL
                SELECT reviewer2_id FROM review_conference_schedules WHERE reviewer2_id IS NOT NULL
                UNION ALL
                SELECT reviewer3_id FROM review_conference_schedules WHERE reviewer3_id IS NOT NULL
            ) as all_reviewers'))
                        ->groupBy('reviewer_id')
                        ->havingRaw('COUNT(*) >= 3');
                })
                ->get();
        }

        return view('admin.reviewer.conferenceschedule', compact('topics', 'papers', 'reviewers', 'topicId'));
    }


    public function select(Request $request)
    {
        $topicId = $request->input('topic_id'); // Get selected topic ID from query

        // Get all papers with their topic loaded
        $allPapers = ConferenceSubmission::with('topics')->get();

        // Extract unique topics from all papers
        $topics = $allPapers->pluck('topics')->unique('id')->values();

        // If a topic is selected, filter papers by that topic AND paper_path is not empty
        if ($topicId) {
            $papers = ConferenceSubmission::where('topic_id', $topicId)
                ->whereNotNull('paper_path')
                ->where('paper_path', '<>', '')
                ->get();
        } else {
            $papers = collect();  // empty collection or you can choose to show all papers if you want
        }

        $reviewers = User::whereHas('roles', function ($query) {
            $query->where('name', 'reviewer');
        })->get();

        return view('admin.reviewer.conferenceschedule', compact('topics', 'papers', 'reviewers', 'topicId'));
    }

    public function store(Request $request)
    {
        //Log::info($request->all());
        $request->validate([
            'conference_submission_id' => 'required|exists:conference_submissions,id',
            'reviewer1_id' => 'required|exists:users,id',
            'reviewer2_id' => 'required|exists:users,id',
            'reviewer3_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);


        ReviewConferenceSchedule::create($request->all());

        return redirect()->route('admin.schedule.conference')->with('success', 'Schedule created!');
    }
    public function edit($id)
    {
        $schedules = ReviewConferenceSchedule::findOrFail($id);
        $submission = ConferenceSubmission::find($id);
        $selectedTopicName = optional(\App\Models\Topic::find($submission->topic_id))->name;
        // $schedules = ReviewJournalSchedule::findOrFail($id);
        $reviewers = User::whereHas('roles', function ($query) {
            $query->where('name', 'reviewer');
        })
            ->whereRaw("FIND_IN_SET(?, field)", [$selectedTopicName])
            ->whereNotIn('id', function ($query) {
                $query->select('reviewer_id')
                    ->from(DB::raw('(
                SELECT reviewer1_id AS reviewer_id FROM review_journal_schedules WHERE reviewer1_id IS NOT NULL
                UNION ALL
                SELECT reviewer2_id FROM review_journal_schedules WHERE reviewer2_id IS NOT NULL
                UNION ALL
                SELECT reviewer3_id FROM review_journal_schedules WHERE reviewer3_id IS NOT NULL
                UNION ALL
                SELECT reviewer1_id FROM review_conference_schedules WHERE reviewer1_id IS NOT NULL
                UNION ALL
                SELECT reviewer2_id FROM review_conference_schedules WHERE reviewer2_id IS NOT NULL
                UNION ALL
                SELECT reviewer3_id FROM review_conference_schedules WHERE reviewer3_id IS NOT NULL
            ) as all_reviewers'))
                    ->groupBy('reviewer_id')
                    ->havingRaw('COUNT(*) >= 3');
            })
            ->get();

        return view('admin.reviewer.editconference', compact('schedules', 'reviewers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'paper' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // max 20MB
            'reviewer1_id' => 'nullable|exists:users,id',
            'reviewer2_id' => 'nullable|exists:users,id',
            'reviewer3_id' => 'nullable|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $schedule = ReviewConferenceSchedule::findOrFail($id);

        $schedule->update($request->only(['reviewer1_id', 'reviewer2_id', 'reviewer3_id', 'start_date', 'end_date']));

        $conferenceSubmission = ConferenceSubmission::findOrFail($schedule->conference_submission_id);

        // Update JournalSubmission if a new paper is uploaded
        if ($request->hasFile('paper')) {
            $filePath = $request->file('paper')->store('conferences/papers', 'public');
            $conferenceSubmission->paper_path = $filePath;
            $conferenceSubmission->save();
        }


        return redirect()->route('admin.schedule.conferenceview')->with('success', 'Schedule updated successfully!');
    }


    // Delete user
    public function destroy($id)
    {
        $schedule = ReviewConferenceSchedule::findOrFail($id);

        $schedule->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function upload($id)
    {
        $data = ReviewConferenceSchedule::findOrFail($id);

        if (!is_null($data->status)) {
            $data->update([
                'status' => null
            ]);
        } else {
            $data->update([
                'status' => 'send'
            ]);
        }

        return redirect()->back()->with('success', 'Paper send successfully!');
    }
    public function destroyReturnConference($id)
    {
        $review = ConferenceReview::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Conference review deleted successfully.');
    }
    public function toggleStatus($id)
    {
        $review = ConferenceReview::findOrFail($id);
        $review->status = $review->status === 'sent' ? 'draft' : 'sent';
        $review->save();
        if ($review->status === 'sent') {
            $submission = $review->conferenceSubmission;
            // or conferenceSubmission if appropriate

            if ($submission && ($author = $submission->author ?? $submission->user)) {
                $author->notify(new ReviewDecisionNotification($submission, $review));
            }
        }

        return redirect()->back()->with('success', 'Review status updated.');
    }
}