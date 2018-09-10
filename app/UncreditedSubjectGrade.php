<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UncreditedSubjectGrade extends Model
{
    protected $table = "uncredited_subject_grades";
    protected $primaryKey = "sg_id";
    protected $fillable = ['gen_ave', 'final_grade'];

    public function uncreditedSubject()
    {
    	return $this->belongsTo(UncreditedSubject::class, 'ucs_id');
    }
}
