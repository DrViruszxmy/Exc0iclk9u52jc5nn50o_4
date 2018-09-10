<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ACSNotification extends Model
{
    protected $connection = 'acs_database';
    protected $table = "notifications";
    protected $primaryKey = "notiId";
    protected $fillable = ['notiStatus', 'notiDate', 'notiType', 'notiSem', 'notiSy', 'ssi_id'];
    public $timestamps = false;
    
    public function student()
    {
    	return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }
}
