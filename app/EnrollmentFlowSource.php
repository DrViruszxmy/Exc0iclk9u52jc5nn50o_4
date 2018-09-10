<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollmentFlowSource extends Model
{
    protected $table = "enrollment_flow_sources";
    protected $primaryKey = "ef_id";
    protected $fillable = ['steps_title', 'location', 'mod_id', 'img_path', 'step_number'];

    public function classifications()
    {
        return $this->belongsToMany(EfsVersion::class, 'efs_classifications', 'ef_id', 'efv_id')->withTimestamps();
    }

    public function modules()
    {
    	return $this->belongsTo(Location::class, 'location_id');
    }

}
