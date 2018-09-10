<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumRoomList extends Model
{
    protected $connection = 'curriculum_database';
    protected $table = "room_list";
    protected $primaryKey = "rl_id";

    public function subjectSchedules()
    {
    	return $this->hasMany(CurriculumSchedSubject::class, 'rl_id');
    }
}
