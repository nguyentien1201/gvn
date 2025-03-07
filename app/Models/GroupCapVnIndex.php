<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class GroupCapVnIndex extends Model
{
    use SoftDeletes;

    public $table = 'group_cap_vnindex';

    protected $fillable = [
        'group', 'avg_day',
    ];
    public function getMarketCap()
    {
        $data = $this->orderBy('avg_day', 'asc')->select('group', 'avg_day')->get()->toArray();
        usort($data, function($a, $b) {
            return $b['avg_day'] <=> $a['avg_day'];
        });
        return $data;
    }

}
