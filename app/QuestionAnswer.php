<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $table = "question_answers";
    protected $primaryKey = "qa_id";
    protected $fillable = ['q_id', 'answer', 'details'];

    public function questions()
    {
    	return $this->hasMany(Questions::class, 'qc_id');
    }

    public function student()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }

    public function question()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }

}
