<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    protected $fillable = [
        'name',
        'title',
        'position',
        'affiliation',
        'country',
        'is_acting'
    ];
}
