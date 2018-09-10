<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabGrade extends Model
{
	protected $table = "lab_grades";
    protected $primaryKey = "labg_id";
    protected $fillable = ['exercise', 'exam', 'class_standing', 'grade', 'period'];

    public function curriculumGrade()
    {
    	return $this->belongsTo(Gen_Ave::class, 'ga_id');
    }
}
