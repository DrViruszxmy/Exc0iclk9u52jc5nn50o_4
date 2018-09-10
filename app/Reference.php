<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = "references";
    protected $primaryKey = "reference_id";
    protected $fillable = [ 'name', 'position', 'company_name', 'address'];

    public function contact()
    {
    	return $this->hasMany(ReferenceContactNumber::class, 'reference_id');
    }

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
