<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegQueueingDepartment extends Model
{
    protected $table = "reg_queueing_departments";
    protected $primaryKey = "rqd_id";
    protected $fillable = ['status', 'reg_user', 'date_reg', 'department_id'];

    public function department()
    {
    	return $this->belongsTo(DTRPSDepartment::class, 'department_id');
    }
}
