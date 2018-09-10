<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    protected $table = "question_categories";
    protected $primaryKey = "qc_id";
    protected $fillable = ['title'];

    public function questions()
    {
    	return $this->hasMany(Questions::class, 'qc_id');
    }
}
