<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectSuggest extends Model
{
    protected $table = "subject_suggests";
    protected $primaryKey = "sg_id";
    protected $fillable = ['ss_id', 'ssi_id', 'sch_year', 'semester'];

    public function schoolInfo()
    {
    	return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }

    public function curriculumSchedSubject()
    {
        return $this->belongsTo(CurriculumSchedSubject::class, 'ss_id');
    }

}
