<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivationHistory extends Model
{
    protected $table = "activation_histories";
    protected $primaryKey = "th_id";
    protected $fillable = ['responsible' ,'date', 'time', 'registered_ip', 'trans_type'];

    public function program()
    {
    	return $this->belongsTo(ProgramList::class, 'pl_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'responsible');
    }
}
