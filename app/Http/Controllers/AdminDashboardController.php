<?php

namespace App\Http\Controllers;

use App\Models\JournalReview;
use App\Models\JournalSubmission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function admin_dash(){
        $reviewer_count = User::whereHas('roles', function ($query) {
            $query->where('name', 'reviewer');
        })->count();

        $author_count = User::whereHas('roles', function ($query) {
            $query->where('name', 'author');
        })->count();

        $request_paper_journals_count = JournalSubmission::count();
        $published_journals_count = $publish_journals = JournalReview::where('evaluation', 'published')->count();
        return view('admin.dashboard', compact('reviewer_count', 'author_count', 'request_paper_journals_count', 'published_journals_count'));
    }
}
