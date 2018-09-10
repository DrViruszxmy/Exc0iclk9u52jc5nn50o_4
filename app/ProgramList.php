<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramList extends Model
{
    protected $table = "program_list";
    protected $primaryKey = "pl_id";
    protected $fillable = ['prog_name', 'prog_abv', 'prog_code', 'major', 'dep_id', 'prog_type', 'level', 'prog_desc', 'senior_high_track'];


    public function getProgNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getMajorAttribute($value)
    {
        return strtoupper($value);
    }

    public function students()
    {
        return $this->belongsToMany(StudentSchoolInfo::class, 'stud_program', 'pl_id', 'ssi_id')->withTimestamps();
    }

    public function curriculumCodeList()
    {
        return $this->hasMany(CurriculumCodeList::class, 'pl_id');
    }

    public function curriculumBlockSections()
    {
        return $this->hasMany(CurriculumBlockSection::class, 'pl_id');
    }

    public function ProgramsTaken()
    {
        return $this->hasMany(StudentProgramTaken::class, 'pl_id');
    }

    public function usageStatus()
    {
        return $this->hasOne(Usage_Status::class, 'pl_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

    public function histories()
    {
        return $this->hasMany(ActivationHistory::class, 'pl_id');
    }
    
 //    public function scopeSearchLevel($query, $level)
	// {
	//   	$query->whereHas('programList', function ($q) use ($level) {
	//     	$q->where('level', '=', "$level");
	//   	});
	// }
}
