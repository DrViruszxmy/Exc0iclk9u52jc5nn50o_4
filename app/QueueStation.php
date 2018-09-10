<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QueueStation;

class QueueStation extends Model
{
    protected $connection = 'queue_database';
    protected $table = "station";
    protected $primaryKey = "stationId";

    public function counters()
    {
    	return $this->hasMany(QueueCounter::class, 'stationId');
    }

    public static function station()
    {
    	$station = QueueStation::where('stationName', 'Registrar')->first();
        $queue_counter = $station->counters->where('counterStatus', 'online');
    	return $queue_counter;
    }

    // public static function queueCounter()
    // {
    // 	$station = QueueStation::where('stationName', 'Registrar')->first();
    // 	$queue_counter = $station->counters->where('counterStatus', 'online');
    // 	return $queue_counter;
    // }
}
