<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumPreRequisite extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "pre_requisite";
    protected $primaryKey = "prr_id";

    public function subjectList()
    {
    	return $this->belongsTo(CurriculumSubjectList::class, 'subj_id');
    }
}
