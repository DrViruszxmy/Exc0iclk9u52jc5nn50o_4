<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredUser extends Model
{
    protected $table = "registered_users";
    protected $primaryKey = "ru_id";
    protected $fillable = ['date_created'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
