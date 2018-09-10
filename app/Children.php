<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    protected $table = "childrens";
    protected $primaryKey = "children_id";
    protected $fillable = ['full_name', 'name_of_school', 'date_of_birth', 'gender'];

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
