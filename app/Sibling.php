<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    protected $table = "siblings";
    protected $primaryKey = "sib_id";

    public function studentPersonalInfo()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }

    public function student()
    {
    	return $this->belongsTo(Student::class, 'stud_id');
    }
}
