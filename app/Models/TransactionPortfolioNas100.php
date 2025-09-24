<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionPortfolioNas100 extends Model
{
    use SoftDeletes;
    public $table = 'transaction_portfolio_nas100';
    protected $fillable = [
        'time',
        'buy',
        'hold',
        'sell',
        'cash',
        'updated_at',
        'created_at'
    ];
    public function getTransactionPortfolioApi(){
        $data = $this->orderBy('time','asc')->select('*')->get();
        if($data){
            $data = $data->toArray();
        }
        $labels = [];
        $buy = [];
        $sell = [];
        $hold = [];
        $cash = [];
        foreach ($data as $item) {
            $total = $item['buy'] + $item['sell'] + $item['hold'] + $item['cash'];
            $labels[] = $item['time'];
            $b = $item['buy'] == 0 ? 0 : round(($item['buy']  / $total) * 100, 2);
            $s = $item['sell'] == 0 ? 0 : round(($item['sell'] / $total) * 100, 2);
            $h = $item['hold'] == 0 ? 0 : round(($item['hold'] / $total) * 100, 2);
            $c = 100 - ($b + $s + $h);
            $buy[]  = $b;
            $sell[] = $s;
            $hold[] = $h;
            $cash[] = $c;
        }
        return [
            'labels' => $labels,
            'buy'=> $buy,
            'sell' => $sell,
            'hold' => $hold,
            'cash' => $cash
        ];
    }
}
