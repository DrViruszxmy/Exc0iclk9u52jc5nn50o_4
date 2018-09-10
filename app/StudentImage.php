<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentImage extends Model
{
    protected $table = "stud_image";
    protected $primaryKey = "simg_id";
    protected $fillable = ['image_path', 'image_name', 'type'];

    public function studentPersonalInfo()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }
}
