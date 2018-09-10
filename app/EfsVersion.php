<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EfsVersion extends Model
{
    protected $table = "efs_versions";
    protected $primaryKey = "efv_id";
    protected $fillable = ['flow_name', 'level', 'student_type', 'status', 'version'];

    public function classifications()
    {
        return $this->belongsToMany(EnrollmentFlowSource::class, 'efs_classifications', 'efv_id', 'ef_id')
			        ->withPivot('efc_id')
			        ->withTimestamps();
    }
}
