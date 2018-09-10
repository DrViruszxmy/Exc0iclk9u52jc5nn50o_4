<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = "trainings";
    protected $primaryKey = "training_id";
    protected $fillable = ['title', 'no_of_hours', 'from', 'to'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
