<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumSchedDay extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "sched_day";
    protected $primaryKey = "sd_id";

    public function subjectSchedules()
    {
    	return $this->hasMany(CurriculumSchedSubject::class, 'sd_id');
    }
}
