<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $table = "contact_people";
    protected $primaryKey = "contact_person_id";
    protected $fillable = [ 'name', 'address'];

    public function contact()
    {
    	return $this->hasMany(ContactPersonNumber::class, 'contact_person_id');
    }

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
