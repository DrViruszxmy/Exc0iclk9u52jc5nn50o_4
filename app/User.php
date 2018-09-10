<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'user_id';
    protected $fillable = ['username', 'password', 'employee_id', 'account_span', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employee()
    {
        return $this->belongsTo(DTRPSEmployee::class, 'employee_id');
    }

    public function accessiblities()
    {
        return $this->belongsToMany(SubModuleList::class, 'accessibilities', 'user_id', 'sml_id')->withTimestamps();
    }
  
    public function logs()
    {
        return $this->hasMany(Loghistory::class, 'user_id');
    }

    public function register()
    {
        return $this->hasOne(RegisteredUser::class, 'user_id');
    }

    public static function userInfo()
    {
        return User::find(Auth::user()->user_id)->load('employee.employment');
    }
}
