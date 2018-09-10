<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferLog extends Model
{
    protected $table = "transfer_logs";
    protected $primaryKey = "transfer_id";
    protected $fillable = ['datefilled', 'transaction_no', 'sch_year', 'semester', 'ssi_id'];

    public function student()
    {
    	return $this->belongsTo(StudentSchoolInfo::class, 'ssi_id');
    }
}
