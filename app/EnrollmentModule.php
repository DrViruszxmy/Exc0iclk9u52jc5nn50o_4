<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentModule extends Model
{
    protected $primaryKey = "mod_id";
    protected $table = "enrollment_modules";
    protected $fillable = ['module_name'];

    public function enrollmentFlows()
    {
    	return $this->hasMany(EnrollmentFlowSource::class, 'mod_id');
    }
}
