<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;
class TotalInvestment extends Model
{
    use SoftDeletes;

    public $table = 'total_investment';
    protected $fillable = [
    'total_investment'
    ];
    public function getTotalInvestment()
    {
        return self::query()->value('total_investment');
    }
}
