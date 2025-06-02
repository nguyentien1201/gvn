<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Profile extends Model
{
    protected $fillable = ['user_id', 'phone', 'birthday', 'address','name', 'manager_id'];
    use SoftDeletes;

    public $table = 'profile';
       public function UserManager()
    {
        return $this->belongsTo('App\Models\User', 'manager_id','id');
    }
}
