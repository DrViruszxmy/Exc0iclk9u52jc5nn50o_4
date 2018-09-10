<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentType extends Model
{
    protected $table = "stud_type";
    protected $primaryKey = "st_id";
    protected $fillable = ['type', 'description'];

    public function studentSchoolInfos()
    {
    	return $this->hasMany(StudentSchoolInfo::class, 'st_id');
    }
}
