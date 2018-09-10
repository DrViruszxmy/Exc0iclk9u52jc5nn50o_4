<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CurriculumSubjSchedDay extends Model
{
	protected $connection = 'curriculum_database';
    protected $table = "subj_sched_day";
    protected $primaryKey = "ssd_id";
    protected $fillable = ['time_start', 'time_end'];

    public function getTimeEndAttribute($date)
    {
        $dt = new Carbon($date);
        return $dt->format('h:i A');
    }

    public function getTimeStartAttribute($date)
    {
        $dt = new Carbon($date);
        return $dt->format('h:i A');
    }

    public function schedDay()
    {
        return $this->belongsTo(CurriculumSchedDay::class, 'sd_id');
    }

    public function schedSub()
    {
        return $this->belongsTo(CurriculumSchedSubject::class, 'ss_id');
    }

    public function roomList()
    {
        return $this->belongsTo(CurriculumRoomList::class, 'rl_id');
    }
}
