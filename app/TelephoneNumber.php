<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelephoneNumber extends Model
{
    protected $table = "telephone_numbers";
    protected $primaryKey = "telephone_id";
    protected $fillable = ['telephone_number'];

    public function studentPersonalInfo()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
