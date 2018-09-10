<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UncreditedSubject extends Model
{
    protected $table = "uncredited_subjects";
    protected $primaryKey = "ucs_id";
    protected $fillable = ['subj_code', 'subj_name', 'subj_desc', 'subj_type', 'sch_year', 'semester', 'subj_credit_number'];

    public function uncreditedGrades()
    {
    	return $this->hasOne(UncreditedSubjectGrade::class, 'ucs_id');
    }

    public function collegeRecord()
    {
    	return $this->belongsTo(CollegeRecord::class, 'cr_id');
    }

    public function highSchoolRecord()
    {
    	return $this->belongsTo(Hschool_Student::class, 'hss_id');
    }

    public function studentSchoolInfo()
    {
    	return $this->belongsTo(studentSchoolInfo::class, 'ssi_id');
    }
}
