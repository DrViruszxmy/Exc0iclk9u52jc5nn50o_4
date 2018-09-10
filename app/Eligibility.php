<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    protected $table = "eligibilities";
    protected $primaryKey = "eligibility_id";
    protected $fillable = ['type', 'rating', 'place_of_exam', 'license_no', 'date_of_exam', 'date_of_release'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
