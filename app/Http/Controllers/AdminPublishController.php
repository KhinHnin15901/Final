<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class AdminPublishController extends Controller
{
    public function journal_publish(){
        $publish_journals = Event::with('journal_submissions')
            ->whereHas('category', function ($query) {
                $query->where('name', 'journal');
            })
            ->whereHas('journal_submissions.review', function($query){
                $query->where('evaluation', 'published');
            })
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->get();
        return view('admin.publish.publish_journal', compact('publish_journals'));
    }

    public function conference_publish() {
         $publish_conferences = Event::with('conference_submissions')
            ->whereHas('category', function ($query) {
                $query->where('name', 'conference');
            })
            ->whereHas('conference_submissions.review', function($query){
                $query->where('evaluation', 'published');
            })
            ->where('status', 'published')
            ->orderByDesc('created_at')
            ->get();
        return view('admin.publish.publish_conference', compact('publish_conferences'));
    }
}
