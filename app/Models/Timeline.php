<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = [
        'year',
        'title',
        'description',
        'icon',
        'color',
        'sort_order',
        'status'
    ];
}
