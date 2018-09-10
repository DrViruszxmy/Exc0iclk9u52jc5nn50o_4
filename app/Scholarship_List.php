<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholarship_List extends Model
{
    protected $table = "scholarship_list";
    protected $primaryKey = "sl_id";
    protected $fillable = ['scholarship_type'];

    public function students()
    {
        return $this->belongsToMany(StudentSchoolInfo::class, 'scholarship', 'sl_id', 'ssi_id')->withTimestamps();
    }
}
