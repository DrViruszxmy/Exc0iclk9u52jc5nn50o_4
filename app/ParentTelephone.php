<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentTelephone extends Model
{
    protected $table = "parents_student";
    protected $primaryKey = "ps_id";
}
