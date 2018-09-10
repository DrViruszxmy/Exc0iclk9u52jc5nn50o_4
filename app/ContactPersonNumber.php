<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPersonNumber extends Model
{
    protected $table = "contact_person_numbers";
    protected $primaryKey = "contact_person_num_id";
    protected $fillable = [ 'number'];

    public function contactPerson()
    {
    	return $this->belongsTo(ContactPerson::class, 'contact_person_id');
    }
}
