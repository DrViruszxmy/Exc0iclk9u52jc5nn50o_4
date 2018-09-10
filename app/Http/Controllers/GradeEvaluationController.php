<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\StudentPersonalInfo;
use App\studentSchoolInfo;
use App\studentPrograms;
use App\programList;
use App\requirementList;
use App\requirements;
use App\CurriculumCodeList;
use App\CurriculumSubject;
use App\CurriculumYearSem;
use App\Date;
use DB;
use Carbon\Carbon;

class GradeEvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('access')->only('index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_year = Date::getCurrentSchoolYear();
         // first sem starts on the first to second weeks of June and ends in October, second sem is starts on the last week of November 'till last week of March. 

        // $school_year = '2016-2017';
        // $semester = '1st';
        // $query = StudentSchoolInfo::find(1)->with('programs.curriculumCodeList.yearSem.curriculumSubject.subjectList')
        //     ->with(['programs' => function ($query) use ($school_year, $semester) {
        //         $query->where('sch_year', '=', $school_year)
        //                 ->where('semester', '=', $semester);
        //     }])
        //     ->first();
        // dd($query);
        // dd(Date::getCurrentSemester());
        
        return view('grade_evaluation.index', compact('school_year'));
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
    public function verifyEval(Request $request)
    {
        $student = StudentSchoolInfo::find($request->input('ssi_id'));
        $student->addEnrollmentProcess(11);

        return ['message' => 'Successfully Verified'];
    }
}
