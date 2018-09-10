<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = "questions";
    protected $primaryKey = "q_id";
    protected $fillable = ['title'];

    public function questionCategory()
    {
    	return $this->belongsTo(QuestionCategory::class, 'qc_id');
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class, 'q_id');
    }

}
