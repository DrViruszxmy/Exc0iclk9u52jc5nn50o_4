<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumSubjectList extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "subject";
    protected $primaryKey = "subj_id";

    public function curriculumSubject()
    {
    	return $this->hasMany(CurriculumSubject::class, 'subj_id');
    }

    public function preRequisite()
    {
    	return $this->hasMany(CurriculumPreRequisite::class, 'subj_id');
    }

    public function subjectSchedule()
    {
    	return $this->hasOne(CurriculumSchedSubject::class, 'subj_id');
    }
}
