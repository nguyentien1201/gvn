<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';

    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'email', 'address', 'note'
    ];

    public function getListCustomers(Request $request)
    {
        $query = self::select();
        if (isset($request->first_name)) {
            $query->where('first_name', 'LIKE', '%' . $request->first_name . '%');
        }
        if (isset($request->last_name)) {
            $query->where('last_name', 'LIKE', '%' . $request->last_name . '%');
        }
        if (isset($request->phone_number)) {
            $query->where('phone_number', $request->phone_number);
        }
        if (isset($request->email)) {
            $query->where('email', $request->email);
        }
        return $query->orderBy('id', 'desc')->paginate(ConstantModel::$PAGINATION);
    }

    public function getCustomerIds()
    {
        return Customer::pluck('id')->toArray();
    }
}
