<?php

namespace App\Http\Controllers;

use App\GradeEncode;
use Illuminate\Http\Request;
use App\CurriculumCodeList;
use App\Date;
use App\ProgramList;
use App\Curr_Used;
use App\Gen_Ave;
use App\CreditingHistory;
use App\StudentPersonalInfo;
use App\StudentSchoolInfo;
use App\GradeStudent;

use Auth;
use Response;
use Carbon\Carbon;




class GradeEncodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        



        $students = StudentPersonalInfo::with('studentSchoolInfo.curriculumUsed.curriculum')
                    ->orderBy('lname', 'asc')
                    ->get();

        foreach ($students as $student) {
            $grades = GradeStudent::orderBy('last', 'asc')
                    ->where('first', $student->fname)
                    ->where('last', $student->lname)
                    ->get();

            if (count($grades)) {
                $student_sch_info = $student->studentSchoolInfo;
                // $curriculum_used = $student->studentSchoolInfo->curriculumUsed;
                // dd($grades);
                foreach ($grades as $grade) {
                    $extr = explode('NFE/', $grade->grades);
                    if (isset($extr[1])) {
                        dd($extr[1]);
                        GradeStudent::where('id', $grade->id)
                        ->update([
                            'grades' => $extr[1]
                        ]);
                    }
                    
                    // $student_sch_info->curriculumUsed()->update([
                    //     'status' => 'inactive'
                    // ]);

                    // if ($grade->CurriculumCode != '' || $grade->CurriculumCode != null) {
                    //     $curriculum_student_used = $student_sch_info->curriculumUsed()->updateOrCreate(
                    //     [
                    //         'c_code' => $grade->CurriculumCode,
                    //         'sch_year' => $grade->CurriculumSY,
                    //         'semester' => $grade->CurriculumSem,
                    //     ], [
                    //         'status' => 'active'
                    //     ]); 

                    //     // $grades = new Gen_Ave($subject);
                    //     // $grades->semester = $curriculum['semester'];
                    //     // $grades->sch_year = $curriculum['school_year'];

                    //     // $curriculum_student_used->subjectGrades()->create([
                    //     //     'grade' => '',
                    //     //     'cs_id' => '',
                    //     //     'semester' => '',
                    //     //     'sch_year' => '',
                    //     // ]);
                    // }
                    
                }
                
            }
           
        }
        
        
        dd('done');

        $programs = ProgramList::distinct()->select('prog_name')->where('level', 'College')->get();
        $majors = ProgramList::distinct('major')->select('major')->where('level', 'College')->get();
        $school_years = Date::school_years('2000');

        return view('grade_encode.index', compact('programs', 'majors', 'school_years'));
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
        $curriculum = $request->input('curriculum');
        $year_level = $request->input('year_level');
        $year_sem = $curriculum['yearSem'];
        $school_year = $curriculum['school_year'];
        $semester = $curriculum['semester'];

        if ($curriculum['eff_sem'] == '1st Semester') {
            $curriculum['eff_sem'] = '1st';
        } else if ($curriculum['eff_sem'] == '2nd Semester') {
            $curriculum['eff_sem'] = '2nd';
        }
        if ($curriculum['semester'] == '1st Semester') {
            $curriculum['semester'] = '1st';
        } else if ($curriculum['semester'] == '2nd Semester') {
            $curriculum['semester'] = '2nd';
        }

        // dd($curriculum['semester']);
        $student = StudentSchoolInfo::where('ssi_id', $curriculum['ssi_id'])->first();

        $curriculum_student_used =   Curr_Used::where('status', 'active')
                                    ->where('c_code', $curriculum['c_code'])
                                    ->where('ssi_id', $curriculum['ssi_id'])
                                    ->first();
        // $student->years()->where('sch_year', '2018-2019')->delete();
        // $student->studentPrograms()->where('sch_year', '2018-2019')->delete();
        // $student->ProgramsTaken()->where('sch_year', '2018-2019')->delete();

        // dd($current_sy);

        //add school year every semester
        $student->years()->updateOrCreate(
            [
                'year' => $year_level,
                'sch_year' => $curriculum['school_year'],
                'semester' => $curriculum['semester']

            ],
            [
                'current_stat' => 'old',
                'remarks' => '',
                'year_stat' => 'regular'
            ]
        );

        //add student program every semester
        $student->studentPrograms()->updateOrCreate(
            [
                'sch_year' => $curriculum['school_year'],
                'semester' => $curriculum['semester'],
                'pl_id' => $curriculum['pl_id']
            ]
        );

        //add student program taken every semester
        $student->ProgramsTaken()->update(
            [
                'sch_year' => $curriculum['school_year'],
                'semester' => $curriculum['semester'],
                'pl_id' => $curriculum['pl_id']
            ]
        );

        if ($curriculum_student_used) {
            $curriculum_student_used->update([
                'c_code' => $curriculum['c_code'],
                'sch_year' => $curriculum['eff_sy'],
                'semester' => $curriculum['eff_sem']
            ]);
        } else {
            

            $student->curriculumUsed()->update([
                'status' => 'inactive'
            ]);

            $curriculum_student_used = $student->curriculumUsed()->create([
                'c_code' => $curriculum['c_code'],
                'sch_year' => $curriculum['eff_sy'],
                'semester' => $curriculum['eff_sem'],
                'status' => 'active'
            ]); 
            // dd('awe');
        }

        foreach ($year_sem as $year) {
            foreach ($year['curriculum_subject'] as $subject) {
                if ($subject['grade'] != '' && $subject['hasGrade'] != true) {

                    $grades = new Gen_Ave($subject);
                    $grades->semester = $curriculum['semester'];
                    $grades->sch_year = $curriculum['school_year'];

                    $curriculum_student_used->subjectGrades()->save($grades);
                }
            }
        }
        
        // $student_school_info = StudentSchoolInfo::find($curriculum['ssi_id']);
        // $student_school_info->addEnrollmentProcess(6);

        return ['message' => 'Successfully Added'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GradeEncode  $gradeEncode
     * @return \Illuminate\Http\Response
     */
    public function show(GradeEncode $gradeEncode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GradeEncode  $gradeEncode
     * @return \Illuminate\Http\Response
     */
    public function edit(GradeEncode $gradeEncode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GradeEncode  $gradeEncode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradeEncode $gradeEncode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GradeEncode  $gradeEncode
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeEncode $gradeEncode)
    {
        //
    }

    public function searchCurriculum(Request $request)
    {
        $student_sch_id = $request->input('ssi_id');
        $program_name = $request->input('program');
        $major = $request->input('major');
        $school_year = $request->input('school_year');
        $semester = $request->input('semester');

        $curriculum_used = StudentSchoolInfo::where('ssi_id', $student_sch_id)
                        ->with('curriculumUsed.subjectGrades.curriculumSubject.subjectList')->first();
       
        $program = ProgramList::where('prog_name', $program_name)->first();
        if ($major != '') {
            $program = ProgramList::where('prog_name', $program_name)->where('major', $major)->first();
        }

        $curriculums = CurriculumCodeList::with(
            'yearSem.curriculumSubject.preRequisite.subjectList',
            'yearSem.curriculumSubject.subjectList.preRequisite.subjectList'
        )->where('pl_id', $program->pl_id)
        ->orderBy('eff_sy', 'asc')
        ->get();

        $available_curriculums = [];
        foreach ($curriculums as $curriculum) {
            $selected_sy = explode('-', $school_year);
            $eff_sy = explode('-', $curriculum->eff_sy);

            if ($selected_sy[0] == $eff_sy[0] && $selected_sy[1] == $eff_sy[1]) {
                $available_curriculums[] = $curriculum;
                // if ($semester == $curriculum->eff_sem) {
                //     $available_curriculums[] = $curriculum;
                //     dd($semester);
                //     return response()->json([
                //         'curriculum_used' => $curriculum_used,
                //         'available_curriculums' => $available_curriculums
                //     ]);
                // }
                return response()->json([
                    'curriculum_used' => $curriculum_used,
                    'available_curriculums' => $available_curriculums
                ]);
            } else if ($selected_sy[1] > $eff_sy[1]) {
                $available_curriculums[] = $curriculum;
            }
        }
        return response()->json([
            'curriculum_used' => $curriculum_used,
            'available_curriculums' => $available_curriculums
        ]);
    }
}
