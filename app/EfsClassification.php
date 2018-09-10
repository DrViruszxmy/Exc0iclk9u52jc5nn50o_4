<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EfsClassification extends Model
{
    protected $table = "efs_classifications";
    protected $primaryKey = "efc_id";

    public function enrollmentflowSource()
    {
    	return $this->belongsTo(EnrollmentFlowSource::class, 'ef_id');
    }
}
