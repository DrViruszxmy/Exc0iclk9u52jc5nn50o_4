<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class CurriculumSchedSubject extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "sched_subj";
    protected $primaryKey = "ss_id";
    // protected $fillable = ['time_start', 'time_end'];

    // public function getTimeEndAttribute($date)
    // {
    //     $dt = new Carbon($date);
    //     return $dt->format('h:i:s A');
    // }

    // public function getTimeStartAttribute($date)
    // {
    //     $dt = new Carbon($date);
    //     return $dt->format('h:i:s A');
    // }

    public function subjectList()
    {
    	return $this->belongsTo(CurriculumSubjectList::class, 'subj_id');
    }

    public function scheduleDays()
    {
        return $this->hasMany(CurriculumSubjSchedDay::class, 'ss_id');
    }

    public function instructor()
    {
        return $this->belongsTo(DTRPSEmployment::class, 'employee_id');
    }

    public function section()
    {
        return $this->belongsTo(CurriculumBlockSection::class, 'bs_id');
    }

    public function finalGrade()
    {
    	return $this->hasOne(ECRSFinalGrade::class, 'ss_id');
    }

    public function subjectsEnrolled()
    {
        $this->connection = 'curriculum_database';
        return $this->hasMany(SubjectEnrolled::class, 'ss_id');
    }

}
