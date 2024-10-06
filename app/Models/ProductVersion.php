<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Carbon\Carbon;
class ProductVersion extends Model
{
    use SoftDeletes;

    public $table = 'product_versions';
    protected $fillable = ['name_product','version_number', 'release_date', 'is_current'];
    public function getReleaseDateAttribute($value)
    {
        if(empty($value)){
            return null;
        }
        return Carbon::parse($value)->format('m-d-Y'); // Customize the format as needed
    }
}
