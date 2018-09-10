<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen_Ave extends Model
{
    protected $table = "gen_ave";
    protected $primaryKey = "ga_id";
    protected $fillable = ['grade', 'semester', 'sch_year', 'cs_id'];

    public function curriculumSubject()
    {
    	return $this->belongsTo(CurriculumSubject::class, 'cs_id');
    }

    public function curriculumUsed()
    {
    	return $this->belongsTo(Curr_Used::class, 'cu_id');
    }

    public function lecGrade()
    {
        return $this->hasMany(LecGrade::class, 'ga_id');
    }

    public function labGrade()
    {
        return $this->hasMany(LabGrade::class, 'ga_id');
    }

}
