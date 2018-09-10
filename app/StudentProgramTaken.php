<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentProgramTaken extends Model
{
    protected $table = "stud_prog_taken";
    protected $primaryKey = "spth_id";
    protected $fillable = ['sch_year', 'semester', 'stat_id', 'pl_id'];

    public function programList()
    {
    	return $this->belongsTo(ProgramList::class, 'pl_id');
    }

    public function studentSchoolInfo()
    {
    	return $this->belongsTo(StudentSchoolInfo::class, 'ssi');
    }

    public function Stud_Stat_List()
    {
    	return $this->belongsTo(Stud_Stat_List::class, 'ssi');
    }
}
