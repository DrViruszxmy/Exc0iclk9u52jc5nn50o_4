<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Short_Course_Student extends Model
{
    protected $table = "short_course_student";
    protected $primaryKey = "scs_id";
    protected $fillable = ['fname', 'mname', 'lname', 'suffix', 'birthdate', 'birthplace','gender', 'civ_status', 'blood_type', 'weight', 'height', 'cit_id', 'religion'];

    public function shortCourseEnrolledStudents()
    {
        return $this->belongsToMany(Short_Course_List::class, 'short_course_enrolled', 'scs_id', 'scl_id')->withTimestamps();
    }
}
