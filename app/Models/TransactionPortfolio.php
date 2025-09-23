<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionPortfolio extends Model
{
    use SoftDeletes;
    public $table = 'transaction_portfolio';
    protected $fillable = [
        'time',
        'buy',
        'hold',
        'sell',
        'cash',
        'updated_at',
        'created_at'
    ];
    
}
