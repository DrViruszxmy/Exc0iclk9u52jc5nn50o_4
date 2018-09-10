<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class AccessList extends Model
{
    protected $table = "access_lists";
    protected $primaryKey = "al_id";
    protected $fillable = ['module_name' ,'module_path'];


   public function subModules()
   {
  		return $this->hasMany(SubModuleList::class, 'al_id');
   }

   public static function userCanAccess()
    {
    	$new_access = [];
        if (Auth::check()) {
            $user = Auth::user()->user_id;
        

            $accesses = AccessList::with('subModules.accessiblities')
                    ->whereHas('subModules.accessiblities', function($query) use ($user){     
                        $query->where('users.user_id', $user);
                    })
                    ->with(['subModules.accessiblities' => function ($query) use ($user){
                        $query->where('users.user_id', $user);
                    }])
                    ->get();

            foreach ($accesses as $access) {
                $arr = [];
                $str = explode('../', $access->image_path);
                if (isset($str[1])) {
                    
                }


                foreach ($access->toArray() as $key => $value) {
                    $arr[$key] = $value;
                    $arr['image_path'] = $access->image_path;
                    // if ($key == 'module_name') {
                    //     if ($value == 'Account Management' 
                    //         || $value == 'Program Settings' 
                    //         || $value == 'Enrollment Process' 
                    //         || $value == 'General Settings' 
                    //         || $value == 'Log History' 
                    //         || $value == 'Queue Settings'
                    //     ) {
                    //         $arr['module_name'] = 'C-Panel';
                    //     }
                    // }
                }
                $new_access[] = $arr;
                
            }

            return $new_access;
        }
    }
}
