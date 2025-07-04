<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Profile;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'activation_token','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function getListCustomers()
    {
        return $this->where('role_id', ConstantModel::ROLES['company'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
    public function getListUser($id)
    {
        $users = User::with('profile')
            ->whereHas('profile', function ($query) use ($id) {
                $query->where('manager_id', $id);
            })
            ->paginate(10); // <-- paging here

        return $users;
    }
    public function getListActive()
    {
        return $this->where('role_id', ConstantModel::ROLES['company'])->where('is_active',0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
