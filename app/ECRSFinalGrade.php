<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ECRSFinalGrade extends Model
{
    protected $connection = 'ecrs_database';
    protected $table = "final_grade";
    protected $primaryKey = "fgrade_id";

    public function curriculumSubjectSched()
    {
    	return $this->belongsTo(CurriculumSchedSubject::class, 'ss_id');
    }
}
