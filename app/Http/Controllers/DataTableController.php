<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\StudentPersonalInfo;
use Yajra\Datatables\Datatables;
use DB;
use Carbon\Carbon;

class DataTableController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
   	public function allData(Request $request)
   	{
   		$level = $request->input('level');
   		$academic_year = $request->input('academicYear');
   		$semester = $request->input('semester');


   		// if($level == 'All'){
   		// 	$query = StudentPersonalInfo::where(DB::raw("CONCAT(fname, ' ',mname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%")
		   //  		->orWhere(DB::raw("CONCAT(fname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%");

		   //  $output['recordsTotal'] = $query->count();

		   //  $load = $query
		   //          ->orderBy('lname')
		   //          ->skip($request->input('start'))
		   //          ->take(10)
		   //          ->get();

	   	// 	$requirements = $load->load('requirements.requirementList');
		   //  $output['data'] = $requirements->load('studentSchoolInfo.studentPrograms.programList');
		   //  $output['recordsFiltered'] = $output['recordsTotal'];
		   //  $output['draw'] = intval($request->input('draw'));

		   //  return $output;
   		// } else{
   		// 	$query = StudentPersonalInfo::where(DB::raw("CONCAT(fname, ' ',mname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%")
		   //  		->orWhere(DB::raw("CONCAT(fname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%");

		   //  $output['recordsTotal'] = $query->count();

		   //  $load = $query->whereHas('studentSchoolInfo.studentPrograms.programList', function($query) use ($level){
			  //           $query->where('level', '=', $level);
			  //       })
		   //          ->orderBy('lname')
		   //          ->skip($request->input('start'))
		   //          ->take(10)
		   //          ->get();

	   	// 	$requirements = $load->load('requirements.requirementList');
		   //  $output['data'] = $requirements->load('studentSchoolInfo.studentPrograms.programList');
		   //  $output['recordsFiltered'] = $output['recordsTotal'];
		   //  $output['draw'] = intval($request->input('draw'));

		   //  return $output;
   		// }




	    
   	// 	if($level == 'All') {
   	// 		$query = StudentPersonalInfo::with('requirements.requirementList', 'studentSchoolInfo.studentPrograms.programList', 
   	// 			 	'studentSchoolInfo.scholarships.scholarshipList')
   	// 			->whereHas('studentSchoolInfo.studentPrograms', function($query) use($request){
    //                 $academic_year = $request->input('academicYear');
   	// 				$semester = $request->input('semester');

    //                 $query->where('semester', '=', $semester);
    //                 $query->where('sch_year', '=', $academic_year);
    //             })
   	// 			->Where(DB::raw("CONCAT(fname,' ',lname)"), 'LIKE', "%".$request->input('search.value')."%")
   	// 			// ->orWhere(DB::raw("CONCAT(fname)"), 'LIKE', "%".$request->input('search.value')."%")
	   //  		// ->orwhere(DB::raw("CONCAT(fname, ' ',mname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%")
    //             ->orderBy('lname')
	   //          ->skip($request->input('start'))
	   //          ->take(10)
	   //          ->get();

	   //      $output['recordsTotal'] = $query->count();

		  //   $output['data'] = $query;
		  //   $output['recordsFiltered'] = $output['recordsTotal'];
		  //   $output['draw'] = intval($request->input('draw'));

		  //  	return $output;
   	// 	} else {
				// $query = StudentPersonalInfo::with('requirements.requirementList', 'studentSchoolInfo.studentPrograms.programList',
   	// 				    'studentSchoolInfo.scholarships.scholarshipList')
   	// 			->WhereHas('studentSchoolInfo.studentPrograms.programList', function($query) use ($request){
   	// 				$level = $request->input('level');
   	// 				$academic_year = $request->input('academicYear');
				// 	$semester = $request->input('semester');
				// 	$query->where('level', '=', $level);
				// 	// $query1->whereHas('programList', function($query) use ($level, $semester, $academic_year, $query1) 
		  //  //        	{     
		  //  //           	$query->where('level', '=', $level);
		  //  //           	$query1->where('semester', '=', $semester);
	   //  //             	$query1->where('sch_year', '=', $academic_year);
		  //  //        	});

	                

	                

   	// 			})
                
	   //  		->where(DB::raw("CONCAT(lname)"), 'LIKE', "%".$request->input('search.value')."%")
	   //  		// ->where(DB::raw("CONCAT(lname)"), 'LIKE', "%".$request->input('search.value')."%")
	   //  		// ->orwhere(DB::raw("CONCAT(fname, ' ',mname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%")
    //             ->orderBy('lname')
	   //          ->skip($request->input('start'))
	   //          ->take(50)
	   //          ->get();

	   //          $output['recordsTotal'] = $query->count();

			 //    $output['data'] = $query;
			 //    $output['recordsFiltered'] = $output['recordsTotal'];
			 //    $output['draw'] = intval($request->input('draw'));

			 //   	return $output;
   	// 	}
	    



   		if($level == 'All') {
	   		$query = StudentPersonalInfo::with('requirements.requirementList', 'studentSchoolInfo.studentPrograms.programList',
	   				'studentSchoolInfo.scholarships.scholarshipList')
   				->Where(DB::raw("CONCAT(fname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%")
   				->orwhere(DB::raw("CONCAT(fname, ' ',mname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%")
	    		->orderBy('lname');
   		} else {

   			$query = StudentPersonalInfo::with('requirements.requirementList', 'studentSchoolInfo.studentPrograms.programList',
   					'studentSchoolInfo.scholarships.scholarshipList')
   					->whereHas('studentSchoolInfo.studentPrograms.programList', function($query) use ($level) 
		          	{     
		             	$query->where('level', '=', $level);
		          	})
	   				->WhereHas('studentSchoolInfo', function($query) use ($request){

	   					$query->WhereHas('studentPrograms', function($query) use ($request){
	   						$academic_year = $request->input('academicYear');
							$semester = $request->input('semester');

							$query->where('semester', '=', $semester)
		               	 		  ->where('sch_year', '=', $academic_year);
	   					});
	   				})
		        	->orderBy('lname');
		}




	    // 	$query = StudentPersonalInfo::where(DB::raw("CONCAT(fname, ' ',lname)"), 'LIKE', "%".$request->input('search.value')."%"	)
	    // 			->select('*')
		   //  		->join('stud_sch_info','stud_sch_info.spi_id','=','stud_per_info.spi_id')
					// ->join('stud_program','stud_program.ssi_id','=','stud_sch_info.ssi_id')
					// ->join('program_list','stud_program.pl_id','=','program_list.pl_id')
		   //  		->orderBy('lname');
   		// }

   		return 	Datatables::of($query)->make(true);
   }
}
