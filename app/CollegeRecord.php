<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegeRecord extends Model
{
    protected $table = "college_record";
    protected $primaryKey = "cr_id";
    protected $fillable = ['sl_id', 'course', 'sch_year', 'year_graduated', 'highest_level','academic_honor', 'last_school'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'college_record_address', 'cr_id', 'add_id')->withTimestamps();
    }

    public function school()
    {
        return $this->belongsTo(SchoolList::class, 'sl_id');
    }
}
