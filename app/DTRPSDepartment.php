<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DTRPSDepartment extends Model
{
    protected $connection = 'dtrps_database';
    protected $table = "departments";
    protected $primaryKey = "department_id";

    public function employment()
    {
    	return $this->hasMany(DTRPSEmployment::class, 'department_id');
    }

}
