<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentProgram extends Model
{
    protected $table = "stud_program";
    protected $primaryKey = "sp_id";
    protected $fillable = ['sch_year' ,'semester', 'pl_id'];

    // public function studentSchoolInfo()
    // {
    // 	return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    // }

    public function programList()
    {
    	return $this->belongsTo(ProgramList::class, 'pl_id');
    }

    public function programShifts()
    {
        return $this->hasMany(Shift_History::class, 'sp_id');
    }
}
