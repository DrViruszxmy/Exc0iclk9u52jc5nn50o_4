<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumSubject extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "cur_subject";
    protected $primaryKey = "cs_id";

    public function grade()
    {
        $this->connection = 'mysql';
        return $this->hasOne(Gen_Ave::class, 'cs_id');
    }
    public function yearSem()
    {
    	return $this->belongsTo(CurriculumYearSem::class, 'ys_id');
    }

    public function preRequisite()
    {
        return $this->hasMany(CurriculumPreRequisite::class, 'cs_id');
    }

    public function subjectList()
    {
    	return $this->belongsTo(CurriculumSubjectList::class, 'subj_id');
    }
}
