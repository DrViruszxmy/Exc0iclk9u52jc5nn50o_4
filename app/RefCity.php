<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefCity extends Model
{
    protected $table = "refcitymun";
    protected $primaryKey = "id";

    public function prov()
    {
    	return $this->belongsTo(RefProv::class, 'provCode');
    }

     public function barangays()
    {
    	return $this->hasMany(RefBrgy::class, 'citymunCode');
    }
}
