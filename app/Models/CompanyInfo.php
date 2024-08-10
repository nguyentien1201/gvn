<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyInfo extends Model
{
    use SoftDeletes;
    protected $googleDriveService;
    public $table = 'company_info';
    protected $fillable = [
        'code','company_name', 'created_at','updated_at','deleted_at'
    ];

}
