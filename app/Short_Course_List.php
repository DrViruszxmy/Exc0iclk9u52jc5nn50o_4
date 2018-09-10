<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Short_Course_List extends Model
{
    protected $table = "short_course_list";
    protected $primaryKey = "scl_id";
    protected $fillable = ['sc_code', 'days', 'course_name', 'time_start', 'time_end', 'date_start', 'date_end', 'description'];

    public function shortCourseTrainors()
    {
    	return $this->belongsToMany(Trainor::class, 'short_course_trainors', 'scl_id', 'trainor_id')->withTimestamps();
    }
}
