<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DTRPSEmployee extends Model
{
    protected $connection = 'dtrps_database';
    protected $table = "employees";
    protected $primaryKey = "employee_id";
    public $incrementing = false;

    public function employment()
    {
    	return $this->hasMany(DTRPSEmployment::class, 'employee_id');
    }

    public function users()
    {
    	return $this->hasOne(User::class, 'employee_id');	
    }

}
