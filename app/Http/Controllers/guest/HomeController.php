<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
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

        // Weather from OpenWeatherMap



        // Get conferences with status 'open' and end_date >= today
        $conferences = DB::table('events')
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->where('events.status', 'published')
            // ->whereDate('events.submission_deadline', '>=', Carbon::today())
            ->where('categories.name', 'conference')
            ->orderByDesc('events.created_at')
            ->select('events.*') // Or include category data if needed
            ->get();


        // Get journals with status 'published' and end_date >= today
        $journals = DB::table('events')
            ->join('categories', 'events.category_id', '=', 'categories.id')
            ->where('events.status', 'published')
            // ->whereDate('events.submission_deadline', '>=', Carbon::today())
            ->where('categories.name', 'journal')
            ->orderByDesc('events.created_at')
            ->select('events.*') // Or include category data if needed
            ->get();


        $user = Auth::user();

        // Optionally eager load unread notifications or paginate
        $notifications = collect(); // default empty collection

        if ($user) {
            $notifications = $user->unreadNotifications->sortByDesc('created_at');
        }


        $today = Carbon::today();
        $conferencesubmissions = collect(); // default empty collection
        $journalsubmissions = collect();
        if ($user) {
            $conferencesubmissions = ReviewConferenceSchedule::where(function ($query) use ($user) {
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
                ->with(['conferenceSubmission.event']) // eager load event if needed
                ->get();

            $journalsubmissions = ReviewJournalSchedule::where(function ($query) use ($user) {
                $query->whereHas('journalSubmission', function ($subQuery) use ($user) {
                    $subQuery->where('user_id', $user->id);
                })
                    ->orWhere(function ($orQuery) use ($user) {
                        $orQuery->where('reviewer1_id', $user->id)
                            ->orWhere('reviewer2_id', $user->id)
                            ->orWhere('reviewer3_id', $user->id);
                    });
            })
                ->where('status', 'send')
                ->whereHas('journalSubmission.event', function ($q) use ($today) {
                    $q->whereDate('submission_deadline', '<', $today);
                })
                ->with(['journalSubmission.event']) // optional eager loading
                ->get();
        }
        $journal = Journal::where('status', 'published')->get();
        $conference = Conference::where('status', 'published')->get();

        $event = Event::latest('id')->first();

        $infos = RegistrationInfo::all()->groupBy('type');
        return view('guest.dashboard', compact('event', 'reg_role', 'infos', 'currentDate', 'conferences', 'conference', 'journals', 'journal', 'topics', 'allKeywords', 'roles', 'conferencesubmissions', 'journalsubmissions', 'topics', 'notifications'), [
            'generalChair' => CommitteeMember::where('position', 'General Chair')->first(),
            'programChair' => CommitteeMember::where('position', 'Program Chair')->first(),
            'members' => CommitteeMember::where('position', 'Member')->orderBy('name')->get(),
        ]);
    }
}
