<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement_List extends Model
{
    protected $table = "requirements_list";
    protected $primaryKey = "rl_id";
    protected $fillable = ['requirements', 'quantity', 'status'];

    public function studentInfo()
    {
    	return $this->belongsToMany(StudentPersonalInfo::class, 'requirements', 'rl_id', 'spi_id')->withTimestamps();
        // return $this->hasMany(Requirement::class, 'rl_id');
    }
}
