<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $table = "work_experiences";
    protected $primaryKey = "work_exp_id";
    protected $fillable = ['years_of_exp', 'position', 'company', 'salary', 'from', 'to'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
