<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEnrollmentStat extends Model
{
    protected $table = "student_enrollment_stat";
    protected $primaryKey = "ses_id";
    protected $fillable = ['status', 'dated', 'sch_year', 'semester'];

    public function studentSchoolInfo()
    {
    	return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }
}
