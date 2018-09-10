<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefProv extends Model
{
    protected $table = "refprovince";
    protected $primaryKey = "id";

    public function cities()
    {
    	return $this->hasMany(RefCity::class, 'provCode');
    }
}
