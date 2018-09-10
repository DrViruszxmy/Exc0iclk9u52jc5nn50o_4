<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectEnrolled extends Model
{
    protected $connection = 'mysql';
    protected $table = "subject_enrolled";
    protected $primaryKey = "se_id";
    protected $fillable = ['ses_id', 'ss_id', 'sch_year', 'semester'];

    public function studentSchoolInfo()
    {
        return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }

    public function curriculumSchedSubject()
    {
        $this->connection = 'curriculum_database';
        return $this->belongsTo(CurriculumSchedSubject::class, 'ss_id');
    }

    public function subjectEnrolledStatus()
    {
        return $this->belongsTo(SubjectEnrolledStatus::class, 'ses_id');
    }

    public function subjectLogs()
    {
        return $this->hasMany(StudSubjectLog::class, 'se_id');
    }
}
