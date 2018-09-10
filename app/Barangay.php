<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = "brgy";
    protected $primaryKey = "brgy_id";
    protected $fillable = ['brgy_name', 'city_id'];

    public function city()
    {
    	return $this->belongsTo(City::class, 'city_id');
    }

    public function addresses()
    {
    	return $this->hasMany(Address::class, 'brgy_id');
    }
}
