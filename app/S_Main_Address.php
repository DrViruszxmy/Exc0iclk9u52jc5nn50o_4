<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class S_Main_Address extends Model
{
    protected $table = "s_main_address";
    protected $primaryKey = "sma_id";
    protected $fillable = ['use_present_address', 'add_id'];
}
