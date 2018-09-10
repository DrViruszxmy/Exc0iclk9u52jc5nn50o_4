<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
	protected $primaryKey = "cit_id";
    protected $table = "citizenship";
    protected $fillable = ['nationality'];

    public function studentPersonalInfos()
    {
    	return $this->hasMany(StudentPersonalInfo::class, 'cit_id');
    }

}
