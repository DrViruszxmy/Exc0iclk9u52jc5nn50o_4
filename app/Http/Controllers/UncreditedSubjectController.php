<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUncreditedSubjectsRequest;
use Illuminate\Http\Request;
use App\UncreditedSubject;
use App\UncreditedSubjectGrade;
use App\Date;

use Response;

class UncreditedSubjectController extends Controller
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
        //
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
    public function store(CreateUncreditedSubjectsRequest $request)
    {

        $subject = $request->input('uncredited_subject');
        $student_status = $subject['student_current_status'];

        $uncredit_sub = new UncreditedSubject($subject);
        if ($student_status != 'trans') {
            $uncredit_sub->hss_id = $subject['school_id'];
        } else {
            $uncredit_sub->cr_id = $subject['school_id'];
        }
        $uncredit_sub->ssi_id = $subject['ssi_id'];
        $uncredit_sub->save();

        $grades = new UncreditedSubjectGrade($subject['uncredited_grades']);
        $uncredit_sub->uncreditedGrades()->save($grades);


        return ['message' => 'Successfully Added'];
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

    public function getAllUncreditedSubjects()
    {
        $id = $_GET['id'];
        $school_year = Date::getCurrentSchoolYear();
        $semester = Date::getCurrentSemester();

        $subjects = UncreditedSubject::where('ssi_id', $id)
            ->with('studentSchoolInfo.years', 'uncreditedGrades')
            ->whereHas('studentSchoolInfo.years', function($query) use ($school_year, $semester) 
            {     
                $query->where('sch_year', '=', $school_year)
                        ->where('semester', '=', $semester);
            })
            ->orderBy('sch_year', 'asc')
            ->get();

        return Response::json($subjects);
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
        
        $student = UncreditedSubject::find($id)->delete();

         return ['message' => 'Successfully Deleted'];
    }

    public function removeUncreditedSubjects(Request $request)
    {
        $subjects = $request->input('remove_uncredited_subject');

        foreach ($subjects as $subject) {
            UncreditedSubject::find($subject)->delete();
        }

        return ['message' => 'Successfully Deleted'];
    }
}
