<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Subscription;
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    protected $fillable = ['name','description', 'monthly_price', 'yearly_price', 'six_month_price','system'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
