<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateCreditedRequest;

use App\Date;
use App\Curr_Used;
use App\Gen_Ave;
use App\CreditingHistory;
use App\StudentPersonalInfo;
use App\StudentSchoolInfo;
use Auth;
use Response;
use Carbon\Carbon;



class SubjectCreditingController extends Controller
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
        $year_list = Date::school_years(2000);
        $school_year = Date::getCurrentSchoolYear();
        $semester = Date::getCurrentSemester();
        
        return view('subject_crediting.index', compact('school_year', 'year_list'));
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
    public function store(CreateCreditedRequest $request)
    {
        $curriculum = $request->input('curriculum');
        $year_sem = $curriculum['yearSem'];
        $school_year = Date::getCurrentSchoolYear();
        $semester = Date::getCurrentSemester();

        $curriculum_student_used = Curr_Used::where('status', 'active')->where('ssi_id', $curriculum['ssi_id'])->first();

        if ($curriculum_student_used) {
            $curriculum_student_used = new Curr_Used($curriculum);
            $curriculum_student_used->semester = $semester;
            $curriculum_student_used->sch_year = $school_year;
            $curriculum_student_used->ssi_id = $curriculum['ssi_id'];
            $curriculum_student_used->status = 'active';
            $curriculum_student_used->save();
        }

        // $history = new CreditingHistory();
        // $history->user_id = Auth::user()->user_id;
        // $history->cu_id = $curriculum_student_used->cu_id;
        // $history->credit_code = StudentPersonalInfo::generateCreditCode();
        // $history->credit_date = Carbon::now();
        // $history->mode = 'New Record';
        // $history->save();

        foreach ($year_sem as $year) {
            foreach ($year['curriculum_subject'] as $subject) {
                if ($subject['grade'] != '' && $subject['hasGrade'] != true) {

                    $grades = new Gen_Ave($subject);
                    $grades->semester = $semester;
                    $grades->sch_year = $school_year;

                    $curriculum_student_used->subjectGrades()->save($grades);
                }
            }
        }
        
        $student_school_info = StudentSchoolInfo::find($curriculum['ssi_id']);
        $student_school_info->addEnrollmentProcess(6);

        return ['message' => 'Successfully Added'];        
        
    }

    public function getCreditedSubjectsHistory()
    {
        $id = $_GET['id'];
        $subjects = Curr_Used::where('ssi_id', $id)->with('creditedHistory.user')
                ->with(['creditedHistory' => function ($query) {
                    $query->orderBy('created_at', 'asc');
                }])
                ->get();

        return Response::json($subjects);
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
    public function update(CreateCreditedRequest $request, $id)
    {
        $curriculum = $request->input('curriculum');
        $year_sem = $curriculum['yearSem'];

        $history = new CreditingHistory();
        $history->user_id = Auth::user()->user_id;
        $history->cu_id = $curriculum['cu_id'];
        $history->credit_code = StudentPersonalInfo::generateCreditCode();
        $history->credit_date = Carbon::now();
        $history->mode = 'Edited';
        $history->save();

        foreach ($year_sem as $year) {
            foreach ($year['curriculum_subject'] as $subject) {
                if ($subject['grade'] != '' && $subject['hasGrade'] == true) {
                    Gen_Ave::where('cs_id', $subject['cs_id'])->update([
                        'grade' => $subject['grade']
                    ]);
                } else {
                    Gen_Ave::where('cs_id', $subject['cs_id'])->delete();
                }
            }
        }

        return ['message' => 'Successfully Updated'];   
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
}
