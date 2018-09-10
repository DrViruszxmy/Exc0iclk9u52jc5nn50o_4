<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift_History extends Model
{
    protected $table = "shift_history";
    protected $primaryKey = "sh_id";

    public function studentProgram()
    {
    	return $this->belongsTo(StudentProgram::class, 'sp_id');
    }
}
