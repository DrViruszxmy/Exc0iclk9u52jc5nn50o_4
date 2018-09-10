<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Stud_Per_Info;
use App\StudentPersonalInfo;
use App\StudentSchoolInfo;
use App\StudentEnrollmentStat;
use App\EfsStudentMode;
use App\Year;
use App\Date;
use DB;
use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'revalidate']);

        $this->middleware('access')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allReqData()
    {
        $table_name = $_GET['tableName'];

        $query = DB::table($table_name)->get();

        return response()->json($query);
    }

    public function verifyStudent(Request $request)
    {
        $student = StudentSchoolInfo::find($request->input('ssi_id'));
        $student->addEnrollmentProcess(1);
        StudentEnrollmentStat::where('ssi_id', $request->input('ssi_id'))
            ->where('sch_year', Date::getCurrentSchoolYear())
            ->where('semester', Date::getCurrentSemester())
            ->update([
                'status' => 'enrolled'
            ]);
            
        return ['message' => 'Successfully Enrolled'];
    }

    public function verifyExam(Request $request)
    {
        $student = StudentSchoolInfo::find($request->input('ssi_id'));
        $student->addEnrollmentProcess(3);

        return ['message' => 'Successfully Verified'];
    }

    public function verifyCashier(Request $request)
    {
        $student = StudentSchoolInfo::find($request->input('ssi_id'));
        $student->addEnrollmentProcess(4);

        return ['message' => 'Successfully Verified'];
    }

    public function verifySgg(Request $request)
    {
        $student = StudentSchoolInfo::find($request->input('ssi_id'));
        $student->addEnrollmentProcess(9);

        return ['message' => 'Successfully Verified'];
    }

    public function verifyAccounting(Request $request)
    {
        $student = StudentSchoolInfo::find($request->input('ssi_id'));
        $student->addEnrollmentProcess(8);

        return ['message' => 'Successfully Verified'];
    }
    
}
