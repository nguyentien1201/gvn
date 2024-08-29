<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubGroupCapDetail extends Model
{
    use SoftDeletes;

    public $table = 'subgroup_cap_detail';

    protected $fillable = [
        'group_name', 'avg_cap', 'date'
    ];

    public function getCurrentCap(){
        $latestDates = $this->orderBy('date', 'desc')
                            ->select('date')
                            ->distinct()
                            ->limit(20)
                            ->pluck('date')
                            ->toArray();

        $data = $this->whereIn('date', $latestDates)->whereNotNull('group_name')
                     ->orderBy('date', 'desc')->select('group_name', 'avg_cap', 'date')
                     ->get()
                     ->toArray();
        $groupNames = [];
        $labels = [];
        usort($data, function($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        $rs = [];
        foreach ($data as $item) {

            $slug_name = Str::slug($item['group_name']);
            if(isset($rs[$slug_name])){
                $rs[$slug_name][] = $item['avg_cap'];
            }else{
                $rs[$slug_name] = [$item['avg_cap']];
            }

            if(!in_array($item['group_name'], $groupNames)){
                $groupNames[] = $item['group_name'];
            }
            $labels[] = $item['date'];
        }
        $rs = array_values($rs);

        foreach ($rs as $keyValue => $value) {
            $total = array_sum($value);
            $percent = [];
            foreach ($value as $key => $item) {
                $percent[$key] = round($item/$total*100, 2);
            }
            $rs[$keyValue] = $percent;
        }

        $groupNames = array_values(array_unique($groupNames));
        $labels = array_values(array_unique($labels));

        $avg_data =  [
            'labels' => $labels,
            'data' => $rs,
            'groupNames' => $groupNames
        ];
        return $avg_data;
    }

}
