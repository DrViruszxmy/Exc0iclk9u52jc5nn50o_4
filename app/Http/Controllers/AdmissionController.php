<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQueueRequest;
use App\Http\Requests\CreateAdmissionRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Requests;
use App\Address;
use App\City;
use App\Country;
use App\Curr_Used;
use App\Citizenship;
use App\SchoolList;
use App\Elementary_Student;
use App\StudentPersonalInfo;
use App\Short_Course_Student;
use App\Hschool_Student;
use App\Province;
use App\Requirement;
use App\Student;
use App\Sibling;
use App\studentSchoolInfo;
use App\StudentEnrollmentStat;
use App\ProgramList;
use App\Date;
use App\Year;
use App\StudentImage;
use App\PhoneNumber;
use App\StudentProgramTaken;
use App\Shift_History;
use App\EfsVersion;
use App\EfStudentUse;
use App\EfsStudentMode;
use App\Scholarship_List;
use App\TransferLog;

use App\QueueStation;
use App\QueueCounter;



use Carbon\Carbon;
use Response;
use Session;
use Validator;
use DB;
use File;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('access')->only('index');
    }
    
    public function querySchool($tableName, $value, $type)
    {
       return DB::table('school_lists')
                ->select('school_lists.sl_id', 'school_lists.school_name', 'school_lists.category', 'spi_id')
                ->join("$tableName", "$tableName.sl_id", '=', 'school_lists.sl_id')
                ->where('school_lists.category', "$type")
                ->where('school_lists.school_name', "$value")
                ->get();
    }

    public static function upadteSchool($array, $tableName, $value)
    {
        if (count($array)) {
            foreach ($array as $list) {
                DB::table($tableName)
                ->where('spi_id', $list->spi_id)
                ->update(['sl_id' => $value]);
            }
        }
    }

    public function index()
    {


        // $junior_high_lists = $this->querySchool('hschool_student', "Unspecifed" ,'junior_high');
        // $senior_high_lists = $this->querySchool('hschool_student', "Unspecifed" ,'senior_high');
        // $college_record_lists = $this->querySchool('college_record', "Unspecifed" ,'college');
        // $elementary_student_lists = $this->querySchool('elementary_student', "Unspecifed" ,'elementary');
        // $vocational_record_lists = $this->querySchool('vocational_record', "Unspecifed" ,'vocational_record');

        // $this::upadteSchool($junior_high_lists, 'hschool_student', 394);
        // $this::upadteSchool($senior_high_lists, 'hschool_student', 394);
        // $this::upadteSchool($college_record_lists, 'college_record', 394);
        // $this::upadteSchool($elementary_student_lists, 'elementary_student', 394);
        // $this::upadteSchool($vocational_record_lists, 'vocational_record', 394);

        // $this::upadteSchool($junior_high_lists, 'hschool_student', 1090);
        // $this::upadteSchool($senior_high_lists, 'hschool_student', 1091);
        // $this::upadteSchool($college_record_lists, 'college_record', 1094);
        // $this::upadteSchool($elementary_student_lists, 'elementary_student', 1092);
        // $this::upadteSchool($vocational_record_lists, 'vocational_record', 1093);

        // dd('success');



        $elementary_lists = SchoolList::where('category', 'elementary')->orderBy('school_name', 'asc')->get();
        $junior_high_lists = SchoolList::where('category', 'junior_high')->orderBy('school_name', 'asc')->get();
        $senior_high_lists = SchoolList::where('category', 'senior_high')->orderBy('school_name', 'asc')->get();
        $college_lists = SchoolList::where('category', 'college')->orderBy('school_name', 'asc')->get();
        $vocational_record_lists = SchoolList::where('category', 'vocational_record')->orderBy('school_name', 'asc')->get();

        $date = Carbon::now('Asia/Manila');
        $date_today = $date->toFormattedDateString();
        // $students = StudentPersonalInfo::find(3)->load('studentSchoolInfo.enrollmentMode.classification.enrollmentflowSource');

        // foreach ($students->studentSchoolInfo->enrollmentMode as $value) {
        //     print_r($value);
        // }
        // dd();
        
        $country = Country::select('country_id as id', 'country_name as value')->orderBy('country_name', 'asc')->get();
        $province = Province::orderBy('province_name', 'asc')->pluck('province_name', 'province_id')->all();
        $citizenship = Citizenship::select('cit_id as id', 'nationality as value')->orderBy('nationality', 'asc')->get();
        $scholarships = Scholarship_List::select('sl_id', 'scholarship_type')->orderBy('scholarship_type', 'asc')->get();
        $suffix = [
                    'Jr.' => 'Jr.', 'Sr.' => 'Sr.','I' => 'I','II' => 'II','III' => 'III',
                    'IV' => 'IV','V' => 'V','VI' => 'VI','VII' => 'VII','VIII' => 'VIII',
                    'IX' => 'IX','X' => 'X'
                ];
        $suffix = $this->prepareArray($suffix);
        $year_list = Date::school_years(1990);

        return view('admission.index', compact('province', 'country', 'suffix', 'citizenship', 'scholarships',
                'date_today', 'year_list', 'vocational_record', 'elementary_lists', 'junior_high_lists', 'college_lists', 'senior_high_lists'));
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
    public function store(CreateAdmissionRequest $request)
    {
        $level = "";
        $student_data = $request->input('student');
        $junior_high = $request->input('junior_high');
        $senior_high = $request->input('senior_high');

        $current_status = $student_data['current_stat'];
        $shift_program = $student_data['shift_program'];
        $contacts = $student_data['contact'];
        $primary_pic = $student_data['primaryselectedpic'];
        $siblings = $student_data['siblings'];
        $enrollee_type = $student_data['enrolleeType'];
        $student_data['year_stat'] = 'regular';
        
        if ($enrollee_type == 'senior_high') {
            $enrollee_type = 2;
            $level = 'Senior High';
        } else if ($enrollee_type == 'college') {
            $enrollee_type = 1;
            $level = 'College';
        } 
        
        
        if ($enrollee_type != 'short_course') {
            $checkCurriculum = ProgramList::with('curriculumCodeList')->where('prog_name', $student_data['program'])->first();
            $this->validate($request, [
                'student.contact.*.phone_number' => 'nullable|numeric|regex:/^(09)[0-9]{9}$/|unique:phone_numbers',
            ]);
            if (! count($checkCurriculum->curriculumCodeList)) {
                $message = "No active curriculum in ". ucwords(strtolower($student_data['program'])) ." Course.";
                return ['error' => $message];
            }

            if ($current_status != 'old' && $current_status != 'returnee') {
                $student_exist = StudentPersonalInfo::where('fname', $student_data['fname'])
                    ->where('mname', $student_data['mname'])
                    ->where('lname', $student_data['lname'])
                    ->first();

                if ($student_exist) {
                    return ['error' => 'Student already exist.'];
                }

                $student = StudentPersonalInfo::create($student_data);

                //save a copy of student for siblings table
                $student_copy = $student->copyStudentPersonalInfo();
                $student_school_info = $student->addSchoolInfo($request->input('stud_id'), $enrollee_type);
                $program = $student_school_info->addProgram($student_data);
                $student_school_info->addCurriculum($program);
            } else {
                if (isset($student_data['spi_id'])) {

                    $student = StudentPersonalInfo::where('spi_id', $student_data['spi_id'])->with('studentSchoolInfo')->first();

                    $student_school_info = $student->studentSchoolInfo;

                    $student_already_exist = StudentEnrollmentStat::where('ssi_id', $student_school_info->ssi_id)
                        ->where('sch_year', Date::getCurrentSchoolYear())
                        ->where('semester', Date::getCurrentSemester())
                        ->first();
                    if ($student_already_exist) {
                        return ['error' => 'Student already enrolled.'];
                    }

                    $program = $student_school_info->addProgram($student_data);
                    $student_copy = Student::where('spi_id', $student->spi_id)->first();
                    $student->phoneNumbers()->delete();

                    // update the student school ID
                    if ($request->input('stud_id')) {
                        $this->validate($request, [
                            'stud_id' => [
                                'nullable',
                                Rule::unique('stud_sch_info')->ignore($student_school_info->ssi_id, 'ssi_id'),
                            ],
                        ]);

                        $student_school_info->update(['stud_id' => $request->input('stud_id')]);
                    }
                }
            }

            $student->addImage($primary_pic, $student_school_info);

            $student->addRequirements($student_data['requirements']);

            $student->addHighSchools($junior_high, 'junior high');

            $student->addHighSchools($senior_high, 'senior high');

            $student->addPhoneNumbers($contacts, $this, $request);

            //create session of student school info for add requirements
            Session::put('student_school_info', $student_school_info);

            if ($student_data['sl_id'] != '') {
                 $student_school_info->scholarships()->attach($student_data['sl_id'], [
                    'semester' => Date::getCurrentSemester(), 
                    'sch_year' => Date::getCurrentSchoolYear()
                ]);
            }

            $student_school_info->addEnrollmentFlow($current_status, $level);

            $student_school_info->addStudentEnrollmentStatus();

            $student_school_info->addSchoolYear($student_data);

            $student_school_info->addEnrollmentProcess(2);

            

            if ($current_status == 'new') {
                $student_school_info->addProgramTaken($program);
            } else {
                if ($shift_program == true) {
                    $stud_program =  $student_school_info->programs[0]->pivot;

                    //add shift history
                    $shift = new Shift_History();
                    $shift->sp_id = $stud_program->sp_id;
                    $shift->save();

                    $student_school_info->addProgramTaken($program);
                }
            }

            if (count($siblings)) {
                Sibling::where('spi_id', $student->spi_id)->delete();
                $student_copy->siblings()->delete();
                
                if (count($siblings) == 1) {

                    foreach ($siblings as $value) {
                        $selectedSibling = Student::where('spi_id', $value['spi_id'])->first();
                        $sibling = new Sibling();
                        $sibling->stud_id = $selectedSibling->stud_id;
                        $sibling->spi_id = $student->spi_id;
                        $sibling->save();
                    }
                }
                foreach ($siblings as $value) {
                    $selectedSibling = Student::where('spi_id', $value['spi_id'])->first();

                    foreach ($siblings as $value2) {
                        if ($selectedSibling->spi_id != $value2['spi_id']) {
                            $sibling = new Sibling();
                            $sibling->stud_id = $selectedSibling->stud_id;
                            $sibling->spi_id = $student->spi_id;
                            $sibling->save();
                        } 
                    }
                    
                }

                foreach ($siblings as $value) {
                    $sibling = new Sibling();
                    $sibling->stud_id = $student_copy->stud_id;
                    $sibling->spi_id = $value['spi_id'];
                    $sibling->save();
                }
                  // dd($siblings);
            }



            // if (count($siblings)) {
            //     if (count($siblings) == 1) {

            //         foreach ($siblings as $value) {
            //             $selectedSibling = Student::where('spi_id', $value['spi_id'])->first();
            //             $sibling = new Sibling();
            //             $sibling->stud_id = $selectedSibling->stud_id;
            //             $sibling->spi_id = $student->spi_id;
            //             $sibling->save();
            //         }
            //     }
            //     foreach ($siblings as $value) {
            //         $selectedSibling = Student::where('spi_id', $value['spi_id'])->first();

            //         foreach ($siblings as $value2) {
            //             if ($selectedSibling->spi_id != $value2['spi_id']) {
            //                 $sibling = new Sibling();
            //                 $sibling->stud_id = $selectedSibling->stud_id;
            //                 $sibling->spi_id = $student->spi_id;
            //                 $sibling->save();
            //             } 
            //         }
                    
            //     }
            //     foreach ($siblings as $value) {
            //         $sibling = new Sibling();
            //         $sibling->stud_id = $student_copy->stud_id;
            //         $sibling->spi_id = $value['spi_id'];
            //         $sibling->save();
            //     }
            // }

        } else {
            $student = Short_Course_Student::create($student_data);
        }
        
        
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

    public function addRequirements(Request $request)
    {
        // $this->validate($request, [
        //     'file' => 'required|mimes:txt'
        // ]);

        $date = new Carbon();
        $student = Session::get('student_school_info');
        $requirements = Requirement::where('spi_id', $student->spi_id)->with('requirementList')->get();

        $type = $request->input('type');

        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();
        $path = 'public/images/student-info/requirements/'. $type .'/'.$student->acct_no;
        $file_path = 'public/images/student-info/requirements/'. $type .'/'.$student->acct_no.'/'.$name;

        if (!File::exists($path)) {
            mkdir($path, 0777);
        } 
        $file->move($path, $name);

        foreach ($requirements as $requirement) {
            if ($type == 'high_school_card') {
                if ($requirement->requirementList->requirements == 'High School Card') {
                    $requirement->files()->create(['file_path' => $file_path]);
                }
            }
            if ($type == 'honorable_dismissal') {
                if ($requirement->requirementList->requirements == 'Honorable Dismissal') {
                    $requirement->files()->create(['file_path' => $file_path]);
                }
            }
            if ($type == 'form137') {
                if ($requirement->requirementList->requirements == 'Form 137-A') {
                    $requirement->files()->create(['file_path' => $file_path]);
                }
            }
            if ($type == 'nso') {
                if ($requirement->requirementList->requirements == 'BC / NSO') {
                    $requirement->files()->create(['file_path' => $file_path]);
                }
            }
            if ($type == 'gmc') {
                if ($requirement->requirementList->requirements == 'GMC') {
                    $requirement->files()->create(['file_path' => $file_path]);
                }
            }
            if ($type == 'tor') {
                if ($requirement->requirementList->requirements == 'TOR') {
                    $requirement->files()->create(['file_path' => $file_path]);
                }
            }
        }
        
        
        
    }

    public function prepareArray($array)
    {
        foreach ($array as $key => $value) {
            $data = new CustomArray($key, $value);
            $new_array[] = $data;
        }

        return $new_array;
    }

    public function city()
    {
        $province = $_GET['province'];

        $city = City::with('barangays')->where('province_id', $province)->first();

        return Response::json($city);
    }

    public function getSearch()
    {
        $date = new Carbon();
        $key = $_GET['key'];
        $type = $_GET['type'];
        $currentStudentId = $_GET['currentStudentId'];
        $school_year = Date::getCurrentSchoolYear();
        $semester = Date::getCurrentSemester();

        if ($type == 'senior_high') {
            $type = 'Senior High';
        } else if ($type == 'college') {
            $type = 'College';
        }

        

        if ($key != '') {
            $query = StudentPersonalInfo::with('studentSchoolInfo.studentEnrollmentStatus', 'siblings', 'students.siblings')
                ->Where('spi_id', '!=', $currentStudentId)
                ->Where(DB::raw("CONCAT(lname, ', ',fname)"), 'LIKE', "%".$key."%")
                ->whereHas('studentSchoolInfo.studentEnrollmentStatus', function($query) use ($school_year, $semester) 
                {    
                    $query->where('sch_year', '=', $school_year)
                        ->where('semester', '=', $semester)
                        ->where('status', '=', 'enrolled');
                })
                ->orderBy('lname')->limit(5)->get();

            if ($type != 'all') {
                $query = StudentPersonalInfo::with('studentSchoolInfo.studentEnrollmentStatus', 'siblings', 'studentSchoolInfo.studentType')
                    ->Where('spi_id', '!=', $currentStudentId)
                    ->Where(DB::raw("CONCAT(lname, ', ',fname)"), 'LIKE', "%".$key."%")
                    ->whereHas('studentSchoolInfo.studentEnrollmentStatus', function($query) use ($school_year, $semester) 
                    {    
                        $query->where('sch_year', '=', $school_year)
                            ->where('semester', '=', $semester)
                            ->where('status', '=', 'enrolled');
                    })
                    ->whereHas('studentSchoolInfo.studentType', function($query) use ($type) 
                    {     
                        $query->where('type', '=', $type);
                    })
                    ->orderBy('lname')->limit(5)->get();
            }
            
            
            return response()->json($query);
        }
        return [];
        
    }

    public function nextQueue(CreateQueueRequest $request)
    {
        $queue = QueueCounter::find($request->input('id'));
        $res = $queue->currentServing + 1;
        $permanentAddress = $queue->update(['currentServing' => $res]);
        return ['message' => $res];
    }

    public function getPrograms()
    {
        $type = $_GET['type'];

        if ($type == 'senior_high') {
            $type = 'Senior High';
        } else if ($type == 'college') {
            $type = 'College';
        }

        $programs = ProgramList::distinct()->select('prog_name', 'prog_code', 'level')
                    ->whereHas('usageStatus', function($query) {
                        $query->where('status', 'active');
                    })
                    ->where('level', $type)
                    ->get();

        return response()->json($programs);
    }

    public function getSearchSchoolName()
    {
        $key = $_GET['key'];
        $category = $_GET['category'];

        return SchoolList::where('school_name', 'LIKE', "%".$key."%")->where('category', $category)->limit(5)->get();
    }

    public function transferCredentials(Request $request)
    {
        $data = $request->input('student');
        $student_school_id = $data['ssi_id'];
        $semester = Date::getCurrentSemester();
        $sch_year = Date::getCurrentSchoolYear();
        TransferLog::create([
            'ssi_id' => $student_school_id,
            'datefilled' => new Carbon(),
            'transaction_no' => generateTransactionNo(),
            'semester' => $semester, 
            'sch_year' => $sch_year
        ]);

        // $status = StudentEnrollmentStat::findOrNew([
        //     'ssi_id' => $student_school_id,
        //     'semester' => $semester, 
        //     'sch_year' => $sch_year
        // ]);
        // $status->ssi_id = $student_school_id;
        // $status->status = 'Transfered';
        // $status->semester = $semester;
        // $status->sch_year = $sch_year;
        // $status->dated = new Carbon();
        // $status->save();

        $status = StudentEnrollmentStat::where('ssi_id', $student_school_id)
                            ->where('semester', $semester)
                            ->where('sch_year', $sch_year)
                            ->first();
        if ($status) {
            $status->update(['status' => 'Transfered']);
        } else {
            StudentEnrollmentStat::create([
                'ssi_id' => $student_school_id,
                'status' => 'Transfered',
                'semester' => $semester,
                'sch_year' => $sch_year,
                'dated' => new Carbon()
            ]);
        }

        return ['message' => 'Successfully Transfered'];
    }
}


class CustomArray
{
    public $id; 
    public $value; 
    function __construct($id, $value)
    {
        $this->id = $id;
        $this->value = $value;
    }
}