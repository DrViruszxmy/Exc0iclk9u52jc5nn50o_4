<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = "relationship";
    protected $primaryKey = "rel_id";
    protected $fillable = ['relationship', 'type_of_rel'];

    public function parents()
    {
    	return $this->hasMany(Parents::class, 'rel_id');
    }
}
