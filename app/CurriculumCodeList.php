<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumCodeList extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "curr_codelist";
    protected $primaryKey = "cur_id";
    // protected $fillable = ['currentServing'];

    // public $timestamps = false;

    public function yearSem()
    {
    	return $this->hasMany(CurriculumYearSem::class, 'cur_id');
    }

    public function program()
    {
        $this->connection = 'mysql';
    	return $this->belongsTo(ProgramList::class, 'pl_id');
    }
}
