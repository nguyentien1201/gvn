<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockSignalVnIndex extends Model
{
    use SoftDeletes;
    protected $googleDriveService;
    public $table = 'stock_signal_vnindex';
    protected $fillable = [
        'code','open_time','open_price', 'close_time', 'close_price','created_at','updated_at','deleted_at'
    ];

}
