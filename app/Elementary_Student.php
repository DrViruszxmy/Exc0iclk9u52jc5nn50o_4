<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elementary_Student extends Model
{
    protected $table = "elementary_student";
    protected $primaryKey = "elementary_id";
    protected $fillable = ['sch_year', 'sector', 'highest_level', 'academic_honor', 'sl_id', 'last_school'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'elementary_address', 'elementary_id', 'add_id')->withTimestamps();
    }

    public function school()
    {
        return $this->belongsTo(SchoolList::class, 'sl_id');
    }
}
