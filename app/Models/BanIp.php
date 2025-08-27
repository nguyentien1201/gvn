<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BanIp extends Model
{
    use SoftDeletes;
    protected $googleDriveService;
    public $table = 'ban_ip';
    protected $fillable = [
        'ip','reason','description'
    ];

}
