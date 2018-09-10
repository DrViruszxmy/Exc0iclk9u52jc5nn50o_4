<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubModuleList extends Model
{
    protected $table = "sub_module_lists";
    protected $primaryKey = "sml_id";
    protected $fillable = ['sub_module'];

    public function mainModule()
   {
  		return $this->belongsTo(AccessList::class, 'al_id');
   }

   public function accessiblities()
    {
        return $this->belongsToMany(User::class, 'accessibilities', 'sml_id', 'user_id')->withTimestamps();
    }
}
