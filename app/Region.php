<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = "regions";
    protected $primaryKey = "reg_id";
    protected $fillable = ['region_name', 'country_id'];

    public function country()
    {
    	return $this->belongsTo(Country::class, 'country_id');
    }

    public function provinces()
    {
    	return $this->hasMany(Province::class, 'reg_id');
    }
}
