<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Date;
use App\SchoolList;
use App\StudentEnrollmentStat;
use App\Hschool_Student;
use App\CurriculumSchedSubject;
use App\StudSubjectLog;
use DB;
use Response;

class ReportController extends Controller
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
        $school_years = StudentEnrollmentStat::distinct()->select('sch_year')->get();

        return view('report.index', compact('school_years'));
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

    public function getStudentsEnrolled()
    {
        $school_lvl = $_GET['school_lvl'];
        $academic_year = $_GET['academic_year'];
        $semester = $_GET['semester'];

        $total_enrolled_students = SchoolList::totalEnrolledStudents($school_lvl, $academic_year, $semester);

        return Response::json($total_enrolled_students);
    }

    public function getTransfereeEnrolled()
    {
        $school_lvl = $_GET['school_lvl'];
        $academic_year = $_GET['academic_year'];
        $semester = $_GET['semester'];

        $total_transferee_students = SchoolList::totalTransfereeStudents($school_lvl, $academic_year, $semester);

        return Response::json($total_transferee_students);
    }


    public function getWithdrawnStudents()
    {
        $school_lvl = $_GET['school_lvl'];
        $academic_year = $_GET['academic_year'];
        $semester = $_GET['semester'];

        $total_withdrawn_students = SchoolList::totalWithdrawnStudents($school_lvl, $academic_year, $semester);

        return Response::json($total_withdrawn_students);


    }

    public function subjectSchedulesAndNoOfStudents()
    {
        $school_lvl = $_GET['school_lvl'];
        $academic_year = $_GET['academic_year'];
        $semester = $_GET['semester'];
        
        return Response::json(SchoolList::subjectSchedulesAndNoOfStudents($school_lvl, $academic_year, $semester));
    }

    public function subjectChangeLog()
    {
        $school_lvl = $_GET['school_lvl'];
        $academic_year = $_GET['academic_year'];
        $semester = $_GET['semester'];
        
        return Response::json(SchoolList::subjectChangeLog($school_lvl, $academic_year, $semester));
    }
}
