<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementFilePath extends Model
{
    protected $table = "requirement_file_paths";
    protected $primaryKey = "req_fp_id";
    protected $fillable = ['file_path'];

    public function requirement()
    {
    	return $this->belongsTo(Requirement::class, 'req_id');
    }
}
