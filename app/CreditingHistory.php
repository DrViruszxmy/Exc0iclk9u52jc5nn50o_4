<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditingHistory extends Model
{
    protected $table = "crediting_history";
    protected $primaryKey = "ch_id";
    protected $fillable = ['credit_code', 'credit_date', 'mode'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function currUsed()
    {
        return $this->belongsTo(Curr_Used::class, 'cu_id');
    }
}
