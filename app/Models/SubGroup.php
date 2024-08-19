<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class SubGroup extends Model
{
    use SoftDeletes;

    public $table = 'rate_subgroup';

    protected $fillable = [
        'group_name', 'previous_session', 'current_year'
    ];

    public function getDataSubGroup($limit = '')
    {
        if($limit != ''){
            $data = $this->orderBy('current_year', 'desc')->select('group_name', 'current_year')->limit($limit)->get();
        }else{
            $data = $this->orderBy('current_year', 'desc')->select('group_name', 'current_year')->get();
        }
        $labels = $data->pluck('group_name')->toArray();
        $rate =$data->pluck('current_year')->toArray();
        return [
            'labels' => $labels,
            'rate' => $rate,
        ];

    }
}
