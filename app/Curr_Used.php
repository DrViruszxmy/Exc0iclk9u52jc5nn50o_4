<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curr_Used extends Model
{
    protected $connection = 'mysql';
    protected $table = "curr_used";
    protected $primaryKey = "cu_id";
    protected $fillable = ['c_code', 'semester', 'sch_year', 'status'];

    public function subjectGrades()
    {
    	return $this->hasMany(Gen_Ave::class, 'cu_id');
    }

    public function creditedHistory()
    {
        return $this->hasMany(CreditingHistory::class, 'cu_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }

     public function curriculum()
    {
        // $this->primaryKey = 'c_code';
        // $this->connection = 'curriculum_database';
        return $this->belongsTo(CurriculumCodeList::class, 'c_code');
    }
}
