<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Profile extends Model
{
    protected $fillable = ['user_id', 'phone', 'birthday', 'address','fullname'];
    use SoftDeletes;

    public $table = 'profile';
}
