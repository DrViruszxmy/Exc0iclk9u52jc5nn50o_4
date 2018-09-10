<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueueCounter extends Model
{
    protected $connection = 'queue_database';
    protected $table = "counter";
    protected $primaryKey = "counterId";
    protected $fillable = ['currentServing'];

    public $timestamps = false;

    public function station()
    {
    	return $this->belongsTo(QueueStation::class, 'stationId');
    }
}
