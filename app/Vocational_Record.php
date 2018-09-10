<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vocational_Record extends Model
{
    protected $table = "vocational_record";
    protected $primaryKey = "vr_id";
    protected $fillable = ['sl_id', 'course', 'sch_year', 'year_graduated', 'highest_level', 'academic_honor', 'last_school'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'vocational_record_address', 'vr_id', 'add_id')->withTimestamps();
    }

    public function school()
    {
        return $this->belongsTo(SchoolList::class, 'sl_id');
    }
}
