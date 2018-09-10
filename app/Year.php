<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = "year";
    protected $primaryKey = "y_id";
    protected $fillable = ['sch_year', 'semester', 'year', 'year_stat', 'remarks', 'current_stat'];

    public function studentSchoolInfo()
    {
    	return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }

    public static function allYears()
    {
    	return Year::distinct()->select('sch_year')->orderBy('sch_year', 'asc')->get();

    }

}
