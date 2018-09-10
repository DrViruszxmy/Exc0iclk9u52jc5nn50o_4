<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents_Student extends Model
{
    protected $table = "parents_student";
    protected $primaryKey = "ps_id";

    public function stud_per_info()
    {
    	return $this->belongsTo(Stud_Per_Info::class, 'spi_id');
    }

    public function relationship()
    {
    	return $this->belongsTo(Relationship::class, 'rel_id');
    }

    public function parent()
    {
    	return $this->belongsTo(Parents::class, 'parent_id');
    }
}
