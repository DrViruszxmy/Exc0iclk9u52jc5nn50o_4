<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "address";
    protected $primaryKey = "add_id";
    protected $fillable = ['street', 'country_id', 'province_id', 'reg_id', 'city_id', 'brgy_id'];

    public function students()
    {
        return $this->belongsToMany(StudentPersonalInfo::class, 's_main_address', 'add_id', 'spi_id')->withTimestamps();
    }

    public function parents()
    {
        return $this->belongsToMany(Parent::class, 'parent_address', 'add_id', 'parent_id')->withTimestamps();
    }

    public function elementaryAddress()
    {
        return $this->belongsToMany(Elementary_Student::class, 'elementary_address', 'add_id', 'elementary_id')->withTimestamps();
    }

    public function highSchoolAddress()
    {
        return $this->belongsToMany(Hschool_Student::class, 'hschool_address', 'add_id', 'hss_id')->withTimestamps();
    }

    public function vocationalAddress()
    {
        return $this->belongsToMany(Vocational_Record::class, 'vocational_record_address', 'add_id', 'vr_id')->withTimestamps();
    }

    public function collegeRecordAddress()
    {
        return $this->belongsToMany(CollegeRecord::class, 'college_record_address', 'add_id', 'cr_id')->withTimestamps();
    }

    public function country()
    {
    	return $this->belongsTo(Country::class, 'country_id');
    }

    public function province()
    {
    	return $this->belongsTo(Province::class, 'province_id');
    }

    public function city()
    {
    	return $this->belongsTo(City::class, 'city_id');
    }

    public function barangay()
    {
    	return $this->belongsTo(Barangay::class, 'brgy_id');
    }
}
