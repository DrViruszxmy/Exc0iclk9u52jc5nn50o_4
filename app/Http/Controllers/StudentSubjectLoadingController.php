<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Date;
use App\CurriculumBlockSection;
use App\CurriculumSchedSubject;
use App\StudentSchoolInfo;
use App\SubjectEnrolled;
use App\StudentEnrollmentStat;
use App\SubjectSuggest;
use App\AccessList;
use App\StudSubjectLog;
use App\ACSNotification;
use App\EfsStudentMode;

use Response;
use Carbon\Carbon;
use Auth;
class StudentSubjectLoadingController extends Controller
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
        $date_today =Carbon::now()->format('d/m/Y');
        return view('student_subject_loading.index', compact('date_today'));
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
        $semester = Date::getCurrentSemester();
        $school_year = Date::getCurrentSchoolYear();
        $student_sch_id = $request->input('ssi_id'); 
        $subjects = $request->input('selectedSubjects');

        $student = StudentSchoolInfo::find($student_sch_id);

        foreach ($subjects as $subject) {
            $sub_endroll = new SubjectEnrolled([
                'ses_id' => 1, 
                'ss_id' => $subject,
                'sch_year' => $school_year,
                'semester' => $semester
            ]);
            $student->enrolledSubjects()->save($sub_endroll);
        }
        // StudentEnrollmentStat::where('ssi_id' ,$student_sch_id)
        //     ->where('sch_year' ,$school_year)
        //     ->where('semester' ,$semester)
        //     ->update(['status' => 'enrolled']);

        $student->addEnrollmentProcess(7);

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

    public function advise(Request $request)
    {
        $subjects = $request->input('selectedSubjects');
        $student_sch_id = $request->input('ssi_id'); 
        $semester = Date::getCurrentSemester();
        $school_year = Date::getCurrentSchoolYear();

        $student = StudentSchoolInfo::find($student_sch_id);
        
        SubjectSuggest::where('ssi_id', $student_sch_id)
                    ->where('semester', $semester)
                    ->where('sch_year', $school_year)
                    ->delete();

        foreach ($subjects as $subject) {
            SubjectSuggest::create([
                'ssi_id' => $student_sch_id,
                'ss_id' => $subject,
                'sch_year' => $school_year,
                'semester' => $semester
            ]);
        }

        $student->addEnrollmentProcess(10);

        return ['message' => 'Successfully Added'];
    }

    public function getBlockSection()
    {
        $year_level = $_GET['yearLevel'];
        $student_program_id = $_GET['studentProgram'];
        $type = $_GET['type'];
        $school_year = Date::getCurrentSchoolYear();
        $semester = Date::getCurrentSemester();
        $student_type = $_GET['studentType'];

        switch ($semester) {
            case '1st':
                $semester = 'First Semester';
                break;
            case '2nd':
                $semester = 'Second Semester';
                break;
        }
        switch ($year_level) {
            case '1st':
                $year_level = 'First Year';
                break;
            case '2nd':
                $year_level = 'Second Year';
                break;
            case '3rd':
                $year_level = 'Third Year';
                break;
            case '4th':
                $year_level = 'Fourth Year';
                break;
        }

        $query = CurriculumBlockSection::with('schedules.subjectList', 'schedules.instructor',
                'schedules.scheduleDays.schedDay', 'schedules.scheduleDays.roomList',
                'schedules.subjectsEnrolled.curriculumSchedSubject.subjectList')
                        ->where('year_lvl', $year_level)
                        ->where('semister', $semester)
                        ->where('sy', $school_year)
                        ->with(['schedules' => function ($query) use ($semester, $school_year) {
                            $query->where('sem', $semester)->where('sy', $school_year);
                        }])
                        ->whereHas('schedules.subjectList', function($query) use ($student_type) {
                            $query->where('subj_type', $student_type);
                        });
                        if ($type == 'offsem') {
                            $query->where('pl_id', 0);
                        } else if ($type == 'block') {
                            $query->where('pl_id', $student_program_id);
                        } 
        $block_sections = $query->get();
                        
        return Response::json($block_sections);
    }

    public function getAllSubject()
    {
        $student_program_id = $_GET['studentProgram'];
        $student_type = $_GET['studentType'];
        $school_year = Date::getCurrentSchoolYear();
        $semester = Date::getCurrentSemester();

        switch ($semester) {
            case '1st':
                $semester = 'First Semester';
                break;
            case '2nd':
                $semester = 'Second Semester';
                break;
        }
        
        $query = CurriculumSchedSubject::with('section', 'subjectList', 'instructor',
                'scheduleDays.schedDay', 'scheduleDays.roomList',
                'subjectsEnrolled.curriculumSchedSubject.subjectList')
                ->whereHas('subjectList', function($query) use ($student_type) {
                    $query->where('subj_type', $student_type);
                })
                ->where('sem', $semester)
                ->where('sy', $school_year)
                ->get();

        return Response::json($query);
    }

    public function dropSubjects(Request $request)
    {
        $semester = Date::getCurrentSemester();
        $school_year = Date::getCurrentSchoolYear();

        $subjects = $request->input('manageSubjects');
        $student_sch_id = $request->input('ssi_id');

        foreach ($subjects as $subject) {
            SubjectEnrolled::where('ssi_id', $student_sch_id)->where('ss_id', $subject['ss_id'])->update(['ses_id' => 2]);

            $subject_enrolled = SubjectEnrolled::where('ssi_id', $student_sch_id)->where('ss_id', $subject['ss_id'])->first();

            $subject_enrolled->subjectLogs()->create([
                'ssi_id' => $student_sch_id,
                'stud_sub_status' => 'drop',
                'stud_sub_date' => new Carbon(),
                'stud_sub_remarks' => 'drop subject'
            ]);
        }

        ACSNotification::create([
            'notiStatus' => 'unread', 
            'notiDate' => new Carbon(), 
            'notiType' => 'dropping', 
            'notiSem' => $semester, 
            'notiSy' => $school_year, 
            'ssi_id' => $student_sch_id
        ]);

        return ['message' => 'Successfully Drop'];
    }

    public function changeSubjects(Request $request)
    {
        $semester = Date::getCurrentSemester();
        $school_year = Date::getCurrentSchoolYear();
        $subjects = $request->input('changeSubjects');
        $from = $subjects['from'];
        $to = $subjects['to'];
        $student_sch_id = $request->input('ssi_id');


        $subject_enrolled = SubjectEnrolled::where('ssi_id', $student_sch_id)->where('ss_id', $from[0]['ss_id'])->first();
        
        $subject_enrolled->subjectLogs()->create([
            'ssi_id' => $student_sch_id,
            'stud_sub_status' => 'change',
            'stud_sub_date' => new Carbon(),
            'stud_sub_remarks' => 'change subject'
        ]);

        $subject_enrolled->update(['ses_id' => 4, 'ss_id' => $to[0]['ss_id']]);

        ACSNotification::create([
            'notiStatus' => 'unread', 
            'notiDate' => new Carbon(), 
            'notiType' => 'changing', 
            'notiSem' => $semester, 
            'notiSy' => $school_year, 
            'ssi_id' => $student_sch_id
        ]);

        return ['message' => 'Successfully Changed'];
    }

    public function addSubjects(Request $request)
    {
        $semester = Date::getCurrentSemester();
        $school_year = Date::getCurrentSchoolYear();
        $subjects = $request->input('manageSubjects');
        $student_sch_id = $request->input('ssi_id'); 
        $semester = Date::getCurrentSemester();
        $school_year = Date::getCurrentSchoolYear();
        
        $student = StudentSchoolInfo::find($student_sch_id);
        foreach ($subjects as $subject) {
            $sub_endroll = new SubjectEnrolled([
                'ses_id' => 3, 
                'ss_id' => $subject['ss_id'],
                'sch_year' => $school_year,
                'semester' => $semester
            ]);
            $student->enrolledSubjects()->save($sub_endroll);

            $sub_endroll->subjectLogs()->create([
                'ssi_id' => $student_sch_id,
                'stud_sub_status' => 'add',
                'stud_sub_date' => new Carbon(),
                'stud_sub_remarks' => 'add subject'
            ]);
        }

        ACSNotification::create([
            'notiStatus' => 'unread', 
            'notiDate' => new Carbon(), 
            'notiType' => 'adding', 
            'notiSem' => $semester, 
            'notiSy' => $school_year, 
            'ssi_id' => $student_sch_id
        ]);

        return ['message' => 'Successfully Added'];
    }

    public function withdrawSubjects(Request $request)
    {
        $semester = Date::getCurrentSemester();
        $school_year = Date::getCurrentSchoolYear();
        $subjects = $request->input('selectedSubjects');
        $student_sch_id = $request->input('ssi_id');
        
        StudentEnrollmentStat::where('ssi_id', $student_sch_id)->update(['status' => 'withdraw']);

        foreach ($subjects as $subject) {
            SubjectEnrolled::where('ssi_id', $student_sch_id)->where('ss_id', $subject)->update(['ses_id' => 5]);

            $subject_enrolled = SubjectEnrolled::where('ssi_id', $student_sch_id)->where('ss_id', $subject)->first();

            $subject_enrolled->subjectLogs()->create([
                'ssi_id' => $student_sch_id,
                'stud_sub_status' => 'withdraw',
                'stud_sub_date' => new Carbon(),
                'stud_sub_remarks' => 'withdraw subject'
            ]);
        }

        ACSNotification::create([
            'notiStatus' => 'unread', 
            'notiDate' => new Carbon(), 
            'notiType' => 'withdrawing', 
            'notiSem' => $semester, 
            'notiSy' => $school_year, 
            'ssi_id' => $student_sch_id
        ]);

        return ['message' => 'Successfully Withdrawn'];
    }
}
