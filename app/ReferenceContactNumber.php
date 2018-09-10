<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferenceContactNumber extends Model
{
    protected $table = "reference_contact_numbers";
    protected $primaryKey = "reference_num_id";
    protected $fillable = [ 'number'];

    public function referencePerson()
    {
    	return $this->belongsTo(Reference::class, 'reference_id');
    }
}
