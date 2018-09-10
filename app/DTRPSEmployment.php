<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DTRPSEmployment extends Model
{
    protected $connection = 'dtrps_database';
    protected $table = "employment";
    protected $primaryKey = "employment_id";

    public function employee()
    {
    	return $this->belongsTo(DTRPSEmployee::class, 'employee_id');
    }

    public function department()
    {
    	return $this->belongsTo(DTRPSDepartment::class, 'department_id');
    }
}
