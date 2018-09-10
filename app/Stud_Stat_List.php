<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stud_Stat_List extends Model
{
    protected $table = "stud_stat_list";
    protected $primaryKey = "stat_id";

    public function studentProgramTaken()
    {
        return $this->hasMany(StudentProgramTaken::class, 'stat_id');
    }
}
