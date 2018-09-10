<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectEnrolledStatus extends Model
{
    protected $table = "subject_enrolled_status";
    protected $primaryKey = "ses_id";

    public function subjectsEnrolled()
    {
        return $this->hasMany(SubjectEnrolled::class, 'ses_id');
    }
}
