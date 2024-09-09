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
        'upMA50', 'downMA50', 'upMA200', 'downMA200','time','nas100'
    ];
    public function getMa(){
        $data = $this->orderBy('time','desc')->select('upMA50','downMA50','upMA200','downMA200')->first()->toArray();
        return $data;
    }
    public function getMaApi(){
        $data = $this->orderBy('time','asc')->select('*')->get()->toArray();
        $labels = [];
        $ma200_values = [];
        $ma50_values = [];
        $nas100_values = [];
        foreach ($data as $item) {
            $labels[] = $item['time'];
            $ma200_values[] = $item['upMA200'];
            $ma50_values[] = $item['upMA50'];
            $nas100_values[] = $item['nas100'];
        }
        return [
            'labels' => $labels,
            'nas100_values'=> $nas100_values,
            'ma200_values' => $ma200_values,
            'ma50_values' => $ma50_values
        ];
    }

}
