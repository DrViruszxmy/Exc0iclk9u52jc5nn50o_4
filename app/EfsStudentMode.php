<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EfsStudentMode extends Model
{
	protected $table = "efs_student_modes";
    protected $primaryKey = "efsm_id";
    protected $fillable = ['efc_id', 'mode', 'date', 'sch_year', 'semester'];

    public function studSchoolInfo()
    {
    	return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }

    public function classification()
    {
    	return $this->belongsTo(EfsClassification::class, 'efc_id');
    }

    
}
