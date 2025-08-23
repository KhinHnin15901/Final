<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\JournalReview;
use App\Models\ReviewConferenceSchedule;
use App\Models\ReviewJournalSchedule;
use App\Models\JournalSubmission;
use App\Models\Keyword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Role;
use App\Models\Topic;
use App\Models\CommitteeMember;
use App\Models\Conference;
use App\Models\Event;
use App\Models\Journal;
use App\Models\RegistrationInfo;
use App\Models\UserPrefix;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $reg_role = $request->role;
        // Date
        $topics = Topic::all();
        $roles = Role::whereNotIn('name', ['admin'])->get();

        $allKeywords = Keyword::orderBy('name')->get();
        $userId = Auth::id();

        // Get topic_ids used in journal submissions
        $journalTopics = \App\Models\JournalSubmission::where('user_id', $userId)
            ->pluck('topic_id');

        // Get topic_ids used in conference submissions
        $conferenceTopics = \App\Models\ConferenceSubmission::where('user_id', $userId)
            ->pluck('topic_id');

        // Merge and get unique topic IDs used
        $usedTopics = $journalTopics->merge($conferenceTopics)->unique()->toArray();

        // Exclude those topics
        $topics = \App\Models\Topic::whereNotIn('id', $usedTopics)->get();

        $currentDate = Carbon::now()->isoFormat('dddd, Do MMMM, YYYY'); // Example: Friday, 12th July, 2025

        // Get conferences with status 'open' and end_date >= today
        $conferences = DB::table('events')
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->where('events.status', 'published')
            // ->whereDate('events.submission_deadline', '>=', Carbon::today())
            ->where('categories.name', 'conference')
            ->orderByDesc('events.created_at')
            ->select('events.*') // Or include category data if needed
            ->get();

        // Get journals with status 'published'
        $journals = Event::with('journal_submissions')
            ->whereHas('category', function ($query) {
                $query->where('name', 'journal');
            })
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->get();


        $user = Auth::user();

        // Optionally eager load unread notifications or paginate
        $notifications = collect(); // default empty collection

        if ($user) {
            $notifications = $user->unreadNotifications->sortByDesc('created_at');
        }


        $today = Carbon::today();
        $conferencesubmissions = collect(); // default empty collection
        $conferencesubmissionsCount = null;
        $journalsubmissions = collect();
        $journalsubmissionsCount = null;
        if ($user) {
            $baseConferencesQuery = ReviewConferenceSchedule::where(function ($query) use ($user) {
                                        $query->whereHas('conferenceSubmission', function ($subQuery) use ($user) {
                                            $subQuery->where('user_id', $user->id);
                                        })
                                        ->orWhere(function ($orQuery) use ($user) {
                                            $orQuery->where('reviewer1_id', $user->id)
                                                ->orWhere('reviewer2_id', $user->id)
                                                ->orWhere('reviewer3_id', $user->id);
                                        });
                                    })
                                    ->where('status', 'send')
                                    ->whereHas('conferenceSubmission.event', function ($q) use ($today) {
                                        $q->whereDate('submission_deadline', '<', $today);
                                    })
                                    ->with(['conferenceSubmission.event']);
            $conferencesubmissions = $baseConferencesQuery->get();
            $conferencesubmissionsCount = (clone $baseConferencesQuery)->count();

            $baseJournalQuery = ReviewJournalSchedule::where(function ($q) use ($user) {
                                $q->where('reviewer1_id', $user->id)
                                ->orWhere('reviewer2_id', $user->id)
                                ->orWhere('reviewer3_id', $user->id);
                            })
                            ->where('status', 'send')
                            ->whereHas('journalSubmission.event', function ($q) use ($today) {
                                $q->whereDate('submission_deadline', '<', $today);
                            })
                            ->with(['journalSubmission.event']);

            $journalsubmissions = $baseJournalQuery->get();
            $journalsubmissionsCount = (clone $baseJournalQuery)->whereDoesntHave('journalSubmission.review', function ($q) use ($userId) {
                                            $q->where(function($q2) use ($userId) {
                                                $q2->where('reviewer1_id', $userId)
                                                ->orWhere('reviewer2_id', $userId)
                                                ->orWhere('reviewer3_id', $userId);
                                            });
                                        })->count();

        }
        $journal = Journal::where('status', 'published')->get();
        $conference = Conference::where('status', 'published')->get();

        $current_issue = JournalReview::latest('id')->first();

        $past_issues = Event::with('journal_submissions')
            ->whereHas('category', function ($query) {
                $query->where('name', 'journal');
            })
            ->whereHas('journal_submissions.review', function($query){
                $query->where('evaluation', 'published');
            })
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->get();

        $event = Event::latest('id')->first();

        $infos = RegistrationInfo::all()->groupBy('type');
        $journal_review = JournalReview::find($request->journal_review_id);
        return view('guest.dashboard', compact('journalsubmissionsCount', 'journal_review', 'conferencesubmissionsCount', 'event', 'reg_role', 'infos', 'currentDate', 'conferences', 'conference', 'journals', 'journal', 'topics', 'allKeywords', 'roles', 'conferencesubmissions', 'journalsubmissions', 'topics', 'notifications', 'user', 'current_issue', 'past_issues'), [
            'generalChair' => CommitteeMember::where('position', 'General Chair')->first(),
            'programChair' => CommitteeMember::where('position', 'Program Chair')->first(),
            'members' => CommitteeMember::where('position', 'Member')->orderBy('name')->get(),
            'user_prefixes' => UserPrefix::get(),
        ]);
    }
}
