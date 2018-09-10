<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudSubjectLog extends Model
{
    protected $table = "stud_subject_logs";
    protected $primaryKey = "stud_sub_id";
    protected $fillable = ['stud_sub_status' ,'stud_sub_date', 'stud_sub_remarks', 'ssi_id'];

    public function subjectEnrolled()
    {
    	return $this->belongsTo(SubjectEnrolled::class, 'se_id');
    }
}
