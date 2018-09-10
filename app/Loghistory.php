<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Loghistory extends Model
{
    protected $table = "loghistories";
    protected $primaryKey = "lh_id";
    protected $fillable = ['date_log_in', 'date_log_out', 'time_log_in', 'time_log_out'];

    public function getTimeLogInAttribute($date)
    {
        $dt = new Carbon($date);
        return $dt->format('h:i A');
    }

    public function getTimeLogOutAttribute($date)
    {
        $dt = new Carbon($date);
        return $dt->format('h:i A');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
