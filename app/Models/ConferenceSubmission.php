<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceSubmission extends Model
{
    protected $fillable = [
        'topic_id',
        'user_id',
        'category_id',
        'event_id',
        'abstract',
        'keywords',
        'paper_path',
        'department_rule_path',
        'professor_rule_path',
    ];
    // public function topic()
    // {
    //     return $this->belongsTo(Topic::class);
    // }
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function topics()
    {
        return $this->belongsTo(Topic::class, 'topic_id'); // or just 'topic' if named that
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reviewSchedule()
    {
        return $this->hasOne(ReviewConferenceSchedule::class, 'conference_submission_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id'); // adjust 'event_id' if your FK is different
    }
    public function review()
    {
        return $this->hasOne(ConferenceReview::class, 'conference_submission_id');
    }
}
