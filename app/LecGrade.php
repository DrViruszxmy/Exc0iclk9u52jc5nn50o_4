<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LecGrade extends Model
{
    protected $table = "lec_grades";
    protected $primaryKey = "lecg_id";
    protected $fillable = ['quiz', 'exam', 'class_standing', 'grade', 'period'];

    public function curriculumGrade()
    {
    	return $this->belongsTo(Gen_Ave::class, 'ga_id');
    }
}
