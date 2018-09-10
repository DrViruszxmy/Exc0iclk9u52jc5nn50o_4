<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    protected $table = "parents";
    protected $primaryKey = "parent_id";
    protected $fillable = ['fname', 'lname', 'mname', 'suffix', 'occupation', 'birthdate', 'office_address', 'deceased'];

    public function setFnameAttribute($fname)
    {
        $this->attributes['fname'] = ucfirst(strtolower($fname));
    }

    public function setMnameAttribute($mname)
    {
        $this->attributes['mname'] = ucfirst(strtolower($mname));
    }

    public function setLnameAttribute($lname)
    {
        $this->attributes['lname'] = ucfirst(strtolower($lname));
    }
    
    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'parent_address', 'parent_id', 'add_id')->withPivot('use_present_address')->withTimestamps();
    }

    public function studentPersonalInfo()
    {
    	return $this->belongsToMany(StudentPersonalInfo::class, 'parents_student', 'parent_id', 'spi_id');
    }

    public function students()
    {
        return $this->hasMany(Parents_Student::class, 'parent_id');
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'email_parent', 'parent_id', 'email_id')->withTimestamps();
    }

    public function phoneNumbers()
    {
        return $this->belongsToMany(PhoneNumber::class, 'parent_phone', 'parent_id', 'phone_id')->withTimestamps();
    }

    public function telephoneNumbers()
    {
        return $this->belongsToMany(TelephoneNumber::class, 'parent_telephones', 'parent_id', 'telephone_id')->withTimestamps();
    }
}
