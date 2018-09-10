<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = "languages";
    protected $primaryKey = "language_id";


    public function students()
    {
        return $this->belongsToMany(StudentPersonalInfo::class, 'language_student', 'language_id', 'spi_id')->withTimestamps();
    }
}
