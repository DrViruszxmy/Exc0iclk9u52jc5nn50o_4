<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "city";
    protected $primaryKey = "city_id";

    public function provinces()
    {
    	return $this->belongsTo(Province::class, 'province_id');
    }

    public function barangays()
    {
    	return $this->hasMany(Barangay::class, 'city_id');
    }

    public function addresses()
    {
    	return $this->hasMany(Address::class, 'city_id');
    }
}
