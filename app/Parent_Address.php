<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent_Address extends Model
{
    protected $table = "parent_address";
    protected $primaryKey = "pu_id";
    protected $fillable = ['use_present_address'];
}
