<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumBlockSection extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "block_section";
    protected $primaryKey = "bs_id";

    public function program()
    {
    	return $this->belongsTo(ProgramList::class, 'pl_id');
    }

    public function subjects()
    {
    	return $this->belongsToMany(CurriculumSubjectList::class, 'block_section_subjects', 'bs_id', 'subj_id')
    		->withPivot('type', 'remaining_hour');
    }

    // public function subjectSchedules()
    // {
    // 	return $this->belongsToMany(CurriculumSchedSubject::class, 'block_section_sched', 'bs_id', 'ss_id')
    // 		->withPivot('sched_type');
    // }

    public function curriculumCodeList()
    {
        return $this->belongsTo(CurriculumCodeList::class, 'cur_id');
    }

    public function schedules()
    {
        return $this->hasMany(CurriculumSchedSubject::class, 'bs_id');
    }
}
