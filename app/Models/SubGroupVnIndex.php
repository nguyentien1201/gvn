<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class SubGroupVnIndex extends Model
{
    use SoftDeletes;

    public $table = 'rate_subgroup_vnindex';

    protected $fillable = [
        'group_name', 'previous_session', 'current_year','quarter','avg_cap','current_month'
    ];

    public function getDataSubGroup($limit = '')
    {
        if($limit != ''){
            $data = $this->orderBy('current_year', 'desc')->select('group_name','previous_session' ,'current_year','current_month','quarter','avg_cap')->limit($limit)->get();
        }else{
            $data = $this->orderBy('current_year', 'desc')->select('group_name','previous_session', 'current_year','current_month','quarter','avg_cap')->get();
        }


        $labels = $data->pluck('group_name')->toArray();
        $rate = $data->pluck('current_year')->toArray();

        return [
            'labels' => $labels,
            'rate' => $rate,
        ];

    }
    public function getDataSubGroupApi()
    {
        $data = $this->whereNotNull('avg_cap')->orderBy('group_name', 'asc')->select('group_name', 'current_year','current_month','quarter','avg_cap')->get()->toArray();
        $current_month = $data;
        usort($current_month, function($a, $b) {
            return $b['current_month'] <=> $a['current_month'];
        });
        $current_month_labels = [];
        $current_month_values = [];
        foreach ($current_month as $item) {
            $current_month_labels[] = $item['group_name'];
            $current_month_values[] = $item['current_month'];
        }

        $current_year = $data;
        usort($current_year, function($a, $b) {
            return $b['current_year'] <=> $a['current_year'];
        });
        $current_year_labels = [];
        $current_year_values = [];
        foreach ($current_year as $item) {
            $current_year_labels[] = $item['group_name'];
            $current_year_values[] = $item['current_year'];
        }

        $quarter = $data;
        usort($quarter, function($a, $b) {
            return $b['quarter'] <=> $a['quarter'];
        });
        $quarter_labels = [];
        $quarter_values = [];
        foreach ($quarter as $item) {
            $quarter_labels[] = $item['group_name'];
            $quarter_values[] = $item['quarter'];
        }

        $avg_cap = $data;
        usort($avg_cap, function($a, $b) {
            return $b['avg_cap'] <=> $a['avg_cap'];
        });
        $avg_cap = array_slice($avg_cap, 0, 10);
        $avg_cap_labels = [];
        $avg_cap_values = [];
        foreach ($avg_cap as $item) {
            $avg_cap_labels[] = $item['group_name'];
            $avg_cap_values[] = $item['avg_cap'];
        }
        return [
            'current_month' => [
                'labels' => $current_month_labels,
                'values' => $current_month_values

            ],
            'current_year' => [
                'labels' => $current_year_labels,
                'values' => $current_year_values

            ],
            'quarter' => [
                'labels' => $quarter_labels,
                'values' => $quarter_values

            ],
            'avg_cap' => [
                'labels' => $avg_cap_labels,
                'values' => $avg_cap_values
            ]
        ];

    }
}
