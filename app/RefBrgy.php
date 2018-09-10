<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RefBrgy extends Model
{
     protected $table = "refbrgy";
    protected $primaryKey = "id";

    public function city()
    {
    	return $this->belongsTo(RefCity::class, 'citymunCode');
    }
}
