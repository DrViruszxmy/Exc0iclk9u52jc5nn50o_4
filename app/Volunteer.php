<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $table = "volunters";
    protected $primaryKey = "volunter_id";
    protected $fillable = ['organization_name', 'position', 'no_of_hours', 'from', 'to'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
