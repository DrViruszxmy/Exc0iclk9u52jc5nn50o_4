<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usage_Status extends Model
{
    protected $table = "usage_status";
    protected $primaryKey = "us_id";
    protected $fillable = ['status'];
}
