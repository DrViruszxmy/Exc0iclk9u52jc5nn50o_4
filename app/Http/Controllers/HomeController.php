<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\City;
use App\StudentPersonalInfo;
use App\Year;
use App\SubjectEnrolled;
use App\Date;
use App\AccessList;
use Auth;
use DB;
use Cache;
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'revalidate']);

        $this->middleware('access')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->user_id;
        $access = AccessList::with('subModules.accessiblities')
                ->whereHas('subModules.accessiblities', function($query) use ($user){     
                    $query->where('users.user_id', $user);
                })
                ->first();

        return redirect(route($access->link));
    }

    public function city(Request $request)
    {
        $province = $request->input('student__pre_province');

        $city = City::with('barangays')->where('province_id', $province)->get();

        return ['address' => $city];
    }

    public function getSearch()
    {
        
        $key = $_GET['key'];
        $type = $_GET['type'];
        $school_year = $_GET['school_year'];
        $semester = $_GET['semester'];
        $enrolltype = $_GET['enrolltype'];
        $current_school_year = Date::getCurrentSchoolYear();
        $current_semester = Date::getCurrentSemester();
        $curriculum_semester = "";

        switch ($semester) {
            case '1st':
                $curriculum_semester = 'First Semester';
                break;
            case '2nd':
                $curriculum_semester = 'Second Semester';
                break;
        }

        switch ($current_semester) {
            case '1st':
                $current_semester = 'First Semester';
                break;
            case '2nd':
                $current_semester = 'Second Semester';
                break;
        }

        if ($type == 'senior_high') {
            $type = 'Senior High';
        } else if ($type == 'college') {
            $type = 'College';
        }

        $tables = ['requirements', 'studentSchoolInfo.scholarships', 'parents.students.relationship', 'parents.addresses', 'childrens', 
                    'studentSchoolInfo.studentType', 'citizenship',
                    'addresses.country', 'addresses.city', 'addresses.province', 'addresses.barangay',
                    'studentSchoolInfo.years', 'emails', 'phoneNumbers', 
                    'studentParents.relationship', 
                    'parents.phoneNumbers', 
                    'parents.telephoneNumbers',
                    'elementarySchools.school',
                    'highSchools.school',
                    'vocationalRecords.school',
                    'collegeRecords.school',
                    'elementarySchools.addresses.country', 'highSchools.addresses.country', 
                    'vocationalRecords.addresses.country', 'collegeRecords.addresses.country', 
                    'elementarySchools.addresses.city', 'highSchools.addresses.city', 
                    'vocationalRecords.addresses.city', 'collegeRecords.addresses.city',
                    'elementarySchools.addresses.province', 'highSchools.addresses.province', 
                    'vocationalRecords.addresses.province', 'collegeRecords.addresses.province', 
                    'elementarySchools.addresses.barangay', 'highSchools.addresses.barangay', 
                    'vocationalRecords.addresses.barangay', 'collegeRecords.addresses.barangay', 

                    'eligibilities', 'workExperiences', 'volunteers', 'trainings', 'studentImages', 'answers', 
                    'students.siblings.studentPersonalInfo.studentImages',
                    'students.siblings.studentPersonalInfo.studentSchoolInfo.years', 
                    'students.siblings.studentPersonalInfo.studentSchoolInfo.programs', 
                    'references.contact', 'ContactPersonInCaseOfEmergency.contact', 







                    'studentSchoolInfo.uncreditedSubjects.uncreditedGrades',
                    
                    'studentSchoolInfo.curriculumUsed.creditedHistory.user',
                    'studentSchoolInfo.curriculumUsed.subjectGrades.lecGrade',
                    'studentSchoolInfo.curriculumUsed.subjectGrades.labGrade',
                    'studentSchoolInfo.curriculumUsed.subjectGrades.curriculumSubject.subjectList.preRequisite',
                    'studentSchoolInfo.curriculumUsed.subjectGrades.curriculumSubject.subjectList.subjectSchedule',

                    'studentSchoolInfo.studentPrograms.programShifts',
                    'studentSchoolInfo.studentPrograms.programList',
                    'studentSchoolInfo.studentEnrollmentStatus',
                    'studentSchoolInfo.programs.curriculumCodeList.yearSem.curriculumSubject.preRequisite.subjectList',
                    'studentSchoolInfo.programs.curriculumCodeList.yearSem.curriculumSubject.subjectList.preRequisite.subjectList',
                    // 'studentSchoolInfo.programs.curriculumCodeList.yearSem.curriculumSubject.subjectList.subjectSchedule.finalGrade',
                    'studentSchoolInfo.enrollmentMode.classification.enrollmentflowSource',
                    'studentSchoolInfo.programs.curriculumCodeList.yearSem.curriculumSubject.grade',


                    'studentSchoolInfo.subjectSuggests',
                    'studentSchoolInfo.subjectSuggests.curriculumSchedSubject.subjectList',
                    'studentSchoolInfo.subjectSuggests.curriculumSchedSubject.scheduleDays.roomList',
                    'studentSchoolInfo.subjectSuggests.curriculumSchedSubject.scheduleDays.schedDay',
                    'studentSchoolInfo.subjectSuggests.curriculumSchedSubject.section',
                    
                    'studentSchoolInfo.enrolledSubjects.subjectEnrolledStatus',
                    'studentSchoolInfo.enrolledSubjects.curriculumSchedSubject.instructor.employee',
                    'studentSchoolInfo.enrolledSubjects.curriculumSchedSubject.subjectList.preRequisite.subjectList',
                    'studentSchoolInfo.enrolledSubjects.curriculumSchedSubject.subjectList.curriculumSubject.grade',
                    'studentSchoolInfo.enrolledSubjects.curriculumSchedSubject.subjectList.curriculumSubject.yearSem.codeList',
                    'studentSchoolInfo.enrolledSubjects.curriculumSchedSubject.scheduleDays.roomList',
                    'studentSchoolInfo.enrolledSubjects.curriculumSchedSubject.scheduleDays.schedDay',
                    'studentSchoolInfo.enrolledSubjects.curriculumSchedSubject.section',

                    
                    
        ];

        if ($key != '') {

            $query = StudentPersonalInfo::where(DB::raw("CONCAT(lname, ', ',fname)"), 'LIKE', "%".$key."%")
                    ->with($tables)
                    ->with(['studentSchoolInfo.uncreditedSubjects' => function ($query) {
                        $query->orderBy('sch_year', 'asc')->orderBy('semester', 'asc');
                    }])
                    ->with(['studentSchoolInfo.programs' => function ($query) {
                        $query->orderBy('sch_year', 'desc')->orderBy('semester', 'desc');
                    }])
                    ->with(['studentSchoolInfo.studentPrograms' => function ($query) {
                        $query->orderBy('sch_year', 'asc')->orderBy('semester', 'asc');
                    }])
                    
                    ->with(['studentSchoolInfo.programs.curriculumCodeList' => function ($query) {
                        $query->where('status', '=', 'active');
                    }])
                    ->with(['studentSchoolInfo.enrolledSubjects.curriculumSchedSubject.subjectList.curriculumSubject.yearSem.codeList' => function ($query) {
                        $query->where('status', '=', 'active');
                    }])
                    
                    ->whereHas('studentSchoolInfo.studentEnrollmentStatus', function($query) use ($school_year, $semester, $enrolltype) 
                    {    
                        if ($enrolltype != 'all') {
                            $query->where('sch_year', '=', $school_year)
                                ->where('semester', '=', $semester)
                                ->where('status', '!=', 'Transfered')
                                ->where('status', '=', $enrolltype);
                        } else {
                            $query->where('sch_year', '=', $school_year)
                                ->where('semester', '=', $semester)
                                ->where('status', '!=', 'Transfered');
                        }
                    })
                    ->whereHas('studentSchoolInfo.years', function($query) {     
                        $query->orderBy('sch_year', 'asc')->orderBy('semester', 'asc');
                    })
        
                    ->with(['studentSchoolInfo.enrolledSubjects.curriculumSchedSubject' => function ($query) use ($school_year, $curriculum_semester) {
                        // $query->withCount('subjectsEnrolled')
                        //         ->where('sy', '=', $school_year)
                        //         ->where('sem', '=', $curriculum_semester);

                        $query->where('sy', '=', $school_year)
                                ->where('sem', '=', $curriculum_semester);
                    }])

                    ->with(['studentSchoolInfo.enrollmentMode' => function ($query) use ($school_year, $semester) {
                            $query->where('sch_year', '=', $school_year)
                                ->where('semester', '=', $semester);
                    }])
                    ->with(['studentSchoolInfo.subjectSuggests' => function ($query) use ($school_year, $semester) {
                            $query->where('sch_year', '=', $school_year)
                                ->where('semester', '=', $semester);
                    }])
                    ->with(['studentSchoolInfo.enrolledSubjects' => function ($query) use ($school_year, $semester) {
                            $query->where('sch_year', '=', $school_year)
                                ->where('semester', '=', $semester);
                    }]);

                    if ($type != 'all') {
                        $query->whereHas('studentSchoolInfo.studentType', function($query) use ($type) 
                        {     
                            $query->where('type', '=', $type);
                        });
                    }

            $result =  $query->orderBy('lname')->limit(5)->get();
                    // ->skip(5)
                    // ->take(5);
                    // ->get();

            // return $datatables->eloquent($result)->make(true);
            // return  Datatables::of($result)->make(true);
            return response()->json($result);
        }
        return [];
        
    }
}
