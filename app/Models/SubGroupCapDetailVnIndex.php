<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubGroupCapDetailVnIndex extends Model
{
    use SoftDeletes;

    public $table = 'subgroup_cap_detail_vnindex';

    protected $fillable = [
        'group_name', 'avg_cap', 'date'
    ];

    public function getCurrentCap(){
        $latestDates = $this->orderBy('date', 'desc')
                            ->select('date')
                            ->distinct()
                            ->limit(10)
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
        $rs_by_date = [];

        $rs_by_date = [];
        foreach ($data as $item) {
            $date = $item['date'];
            if (!isset($rs_by_date[$date])) {
                $rs_by_date[$date] = 0;
            }
            $rs_by_date[$date] += $item['avg_cap'];
        }

        foreach ($data as $item) {
            $slug_name = Str::slug($item['group_name']);
            $percen_value =  round($item['avg_cap']/$rs_by_date[$item['date']]*100, 2);
            if(isset($rs[$slug_name])){
                $rs[$slug_name][] = $percen_value;
            }else{
                $rs[$slug_name] = [$percen_value];
            }

            if(!in_array($item['group_name'], $groupNames)){
                $groupNames[] = $item['group_name'];
            }
            $labels[] = $item['date'];
        }
        $rs = array_values($rs);
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
