<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumYearSem extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "year_sem";
    protected $primaryKey = "ys_id";

    public function codeList()
    {
    	return $this->belongsTo(CurriculumCodeList::class, 'cur_id');
    }

    public function curriculumSubject()
    {
    	return $this->hasMany(CurriculumSubject::class, 'ys_id');
    }
}
