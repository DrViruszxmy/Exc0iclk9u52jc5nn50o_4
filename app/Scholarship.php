<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $table = "scholarship";
    protected $primaryKey = "s_id";


    public function studentSchoolInfo()
    {
    	return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }

    public function scholarshipList()
    {
    	return $this->belongsTo(Scholarship_List::class, 'sl_id');
    }
}