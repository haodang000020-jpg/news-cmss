<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    protected $fillable = [
        'session_id',
        'ip_hash',
        'user_agent_hash',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}