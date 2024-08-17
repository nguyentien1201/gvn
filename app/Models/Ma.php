<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Ma extends Model
{
    use SoftDeletes;

    public $table = 'ma';

    protected $fillable = [
        'upMA50', 'downMA50', 'upMA200', 'downMA200'
    ];


}
