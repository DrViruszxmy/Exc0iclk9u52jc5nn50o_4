<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeStudent extends Model
{
    protected $connection = 'grades_database';
    protected $table = "grades";
    protected $primaryKey = "id";
    protected $fillable = ['CurriculumCode', 'CurriculumSem'];

    // public $timestamps = false;

    // public function yearSem()
    // {
    // 	return $this->hasMany(CurriculumYearSem::class, 'cur_id');
    // }

    // public function program()
    // {
    // 	return $this->belongsTo(ProgramList::class, 'pl_id');
    // }
}
