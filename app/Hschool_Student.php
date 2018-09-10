<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hschool_Student extends Model
{
    protected $table = "hschool_student";
    protected $primaryKey = "hss_id";
    protected $fillable = ['sch_year', 'highest_level','sector', 'academic_honor', 'type', 'sl_id', 'last_school'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'hschool_address', 'hss_id', 'add_id')->withTimestamps();
    }

    public function school()
    {
        return $this->belongsTo(SchoolList::class, 'sl_id');
    }
}
