<?php

// app/Models/Event.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'short_description',
        'content',
        'register_link',
        'start_date',
        'end_date',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
