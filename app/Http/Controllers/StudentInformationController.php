<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateStudentInformationRequest;
use Illuminate\Http\Request;

use App\RefProv;
use App\Address;
use App\StudentPersonalInfo;
use App\StudentSchoolInfo;
use App\Citizenship;
use App\Children;
use App\Country;
use App\CollegeRecord;
use App\Email;
use App\Elementary_Student;
use App\Eligibility;
use App\S_Main_Address;
use App\Hschool_Student;
use App\Language;
use App\StudentEnrollmentStat;
use App\Province;
use App\City;
use App\Barangay;
use App\Parents;
use App\PhoneNumber;
use App\Region;
use App\TelephoneNumber;
use App\Vocational_Record;
use App\Volunteer;
use App\WorkExperience;
use App\Training;
use App\Relationship;
use App\Year;
use App\StudentImage;
use App\Sibling;
use App\Student;
use App\SchoolList;
use App\ProgramList;
use App\QuestionCategory;
use App\QuestionAnswer;
use App\Reference;
use App\ReferenceContactNumber;
use App\ContactPerson;
use App\ContactPersonNumber;
use App\Date;

use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Response;
use Session;
use DB;
use File;

class StudentInformationController extends Controller
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

        // $regions = Region::select('reg_id as id', 'region_name as value')->get();
        $country = Country::select('country_id as id', 'country_name as value')->orderBy('country_name', 'asc')->get();
        $citizenship = Citizenship::select('cit_id as id', 'nationality as value')->orderBy('nationality', 'asc')->get();
        $relationship = Relationship::select('rel_id as id', 'relationship as value')
                    ->where('type_of_rel', 'guardian')->orderBy('relationship', 'asc')->get();
        $question_categories = QuestionCategory::with('questions')->get();
        $elementary_lists = SchoolList::where('category', 'elementary')->orderBy('school_name', 'asc')->get();
        $junior_high_lists = SchoolList::where('category', 'junior_high')->orderBy('school_name', 'asc')->get();
        $senior_high_lists = SchoolList::where('category', 'senior_high')->orderBy('school_name', 'asc')->get();
        $college_lists = SchoolList::where('category', 'college')->orderBy('school_name', 'asc')->get();
        $vocational_record_lists = SchoolList::where('category', 'vocational_record')->orderBy('school_name', 'asc')->get();

        $acct_no = StudentPersonalInfo::generateAccountNo();
        // $languages = Language::select('language_id as id', 'language as value')->orderBy('language', 'asc')->get();
        // $years = Year::distinct()->select('sch_year')->orderBy('sch_year', 'asc')->get();
        $programs = ProgramList::distinct()->select('prog_name', 'prog_code', 'level')->get();
        $gender = ['male' => 'Male', 'female' => 'Female'];
        $civil_status = [
                    'single' => 'Single','married' => 'Married','annulled' => 'Annulled','widowed' => 'Widowed',
                    'separated' => 'Separated','others' => 'Others',
        ];
        $suffix = [
                    'Jr.' => 'Jr.', 'Sr.' => 'Sr.','I' => 'I','II' => 'II','III' => 'III',
                    'IV' => 'IV','V' => 'V','VI' => 'VI','VII' => 'VII','VIII' => 'VIII',
                    'IX' => 'IX','X' => 'X'
                ];
        $sector = ['public' => 'Public', 'private' => 'Private'];
        $choices = ['yes' => 'Yes', 'no' => 'No'];
        $status = ['graduate' => 'Graduate', 'undergraduate' => 'Undergraduate'];
        $blood_type = [
                        'O-' => 'O-', 'O+' => 'O+', 'A-' => 'A-', 'A+' => 'A+', 
                        'B-' => 'B-', 'B+' => 'B+', 'AB-' => 'AB-', 'AB+' => 'AB+',
                    ];
        

        $gender = $this->prepareArray($gender);
        $civil_status = $this->prepareArray($civil_status);
        $suffix = $this->prepareArray($suffix);
        $choices = $this->prepareArray($choices);
        $sector = $this->prepareArray($sector);
        $status = $this->prepareArray($status);
        $blood_type = $this->prepareArray($blood_type);

        return view('student_information.index', compact(
            'country', 'suffix', 'blood_type', 'citizenship', 'relationship', 'acct_no',
            'gender', 'civil_status', 'sector', 'status', 'choices', 'programs', 'question_categories', 'junior_high_lists',
            'senior_high_lists', 'elementary_lists', 'college_lists', 'vocational_record_lists'
        ));
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
    public function store(CreateStudentInformationRequest $request)
    {
        // $date = new Carbon();
        // $studentData = $request->input('student');
        // $primary_pic = $studentData['primaryselectedpic'];
        
        // $childrens = $request->input('children');
        // $siblings = $studentData['siblings'];
        // $father = $request->input('father');
        // $mother = $request->input('mother');
        // $guardian = $request->input('guardian');
        // $elementary = $request->input('elementary');
        // $junior_high = $request->input('junior_high');
        // $senior_high = $request->input('senior_high');
        // $vocational_record = $request->input('vocational_record');
        // $college = $request->input('college');
        // $eligibility = $request->input('eligibility');
        // $work_experience = $request->input('work_experience');
        // $volunteers = $request->input('volunteer');
        // $trainings = $request->input('training');
        // $others = $request->input('other');
        // $references = $request->input('reference');
        // $contactPersonInCaseOfEmergencies = $request->input('contactPersonInCaseOfEmergency');

        // //Format the names
        // foreach ($studentData as $key => $value) {
        //     if($key == 'lname' || $key == 'fname' || $key == 'mname'){
        //         $studentData[$key] = ucfirst(strtolower($value));
        //     }
        // }

        // $student = StudentPersonalInfo::create($studentData);
        // $studentWithSibling = new Student();
        // $new_student = $student->students()->save($studentWithSibling);

        // if ($studentData['presentAddress']['country_id'] != '') {
        //     $presentAddress = Address::create($studentData['presentAddress']);
        //     $student->addresses()->attach($presentAddress->add_id, ['address_type' => 'presentAddress']);
        // }

        // if ($studentData['permanentAddress']['country_id'] != '') {
        //     $permanentAddress = Address::create($studentData['permanentAddress']);
        //     $student->addresses()->attach($permanentAddress->add_id, ['address_type' => 'permanentAddress']);
        // }
        
        // $student_School_info = new StudentSchoolInfo();
        // $student_School_info->stud_id = StudentPersonalInfo::generateAccountNo();
        // $student_School_info->usn_no = StudentPersonalInfo::generateAccountNo();
        // $student_School_info->acct_no = StudentPersonalInfo::generateAccountNo();
        // $student_School_info->st_id = 1;
        
        // $student_enrollment_status = new StudentEnrollmentStat();
        // $student_enrollment_status->status = 'not enrolled';
        // $student_enrollment_status->sch_year = $request->input('school_year');
        // $student_enrollment_status->semester = $request->input('semester');
        // $student_enrollment_status->dated = $date;

        // $student->studentSchoolInfo()->save($student_School_info);
        // $student_School_info->studentEnrollmentStatus()->save($student_enrollment_status);

        // $program = ProgramList::where('prog_name', $studentData['program'])->first();
        // $student_School_info->programs()->attach($program->pl_id, ['semester' => '1st', 'sch_year' => '2016-2017']);

        // if ($primary_pic != 'images/control-panel/account-management/ssg/user-logo.fw.png') {
        //     $filteredData = explode(',', $primary_pic);
        //     $unencoded = base64_decode($filteredData[1]);

        //     //Create the image 
        //     $path = 'images/student-info/photo/primary/'.$student_School_info->acct_no.'/'.$student_School_info->acct_no.'.png';
        //     $fp = fopen($path, 'w');
        //     fwrite($fp, $unencoded);
        //     fclose($fp); 

        //     $student_image = new StudentImage([
        //         'image_path' => $path,
        //         'image_name' => $student_School_info->acct_no.'.png',
        //         'type' => 'primary'
        //     ]);
        //     $student->studentImages()->save($student_image);
        // }

        
        

        // $this->insertContact($request->input('student_email'), $student, 'email');
        // $this->insertContact($request->input('student_telephone_number'), $student, 'telephone_number');
        // $this->insertContact($request->input('student_phone_number'), $student, 'phone_number');

        

        // // langauage info
        // // foreach ($languages as $key => $value) {
        // //     $student_personal_info->languages()->attach($value);
        // // }

       //  foreach ($childrens as $children) {
       //      if ($children['full_name'] != '') {
       //          $children_info = new Children($children);
       //          $student->childrens()->save($children_info);
       //      }
       //  }

       //  if ($siblings) {
       //      foreach ($siblings as $value) {
       //          $sibling = new Sibling();
       //          $sibling->stud_id = $new_student->stud_id;
       //          $sibling->spi_id = $value['spi_id'];
       //          $sibling->save();
       //      }
       //  }
        
       //  //FATHER
       //  if ($father['lname'] != '' && $father['fname'] != '' && $father['mname'] != '') {
       //      //Format the names
       //      foreach ($father as $key => $value) {
       //          if($key == 'lname' || $key == 'fname' || $key == 'mname'){
       //              $father[$key] = ucfirst(strtolower($value));
       //          }
       //      }
       //      if ($father['deceased'] == false) {
       //          $father['deceased'] = 'no';
       //      } else {
       //          $father['deceased'] = 'yes';
       //      }
            
       //      $father_info = new Parents($father);
       //      $father_info->rel_id = 1;
       //      $father_info->save();

       //      // $this->insertContact($request->input('father_email'), $father_info, 'email');
       //      // $this->insertContact($request->input('father_phone_number'), $father_info, 'phone_number');

       //      // $this->insertAddress($father_info, 'pre_', $request->input('father'), '');

       //      if ($father['presentAddress']['country_id'] != '') {
       //          $presentAddress = Address::create($father['presentAddress']);
       //          $father_info->addresses()->attach($presentAddress->add_id);
       //      }

       //      $student->parents()->attach($father_info->parent_id);
       //  }

       //  //MOTHER
       //  if ($mother['lname'] != '' && $mother['fname'] != '' && $mother['mname'] != '') {
       //      //Format the names
       //      foreach ($mother as $key => $value) {
       //          if($key == 'lname' || $key == 'fname' || $key == 'mname'){
       //              $mother[$key] = ucfirst(strtolower($value));
       //          }
       //      }
       //      if ($mother['deceased'] == false) {
       //          $mother['deceased'] = 'no';
       //      } else {
       //          $mother['deceased'] = 'yes';
       //      }

       //      $mother_info = new Parents($mother);
       //      $mother_info->rel_id = 2;
       //      $mother_info->save();

       //      // $this->insertContact($request->input('mother_email'), $mother_info, 'email');
       //      // $this->insertContact($request->input('mother_phone_number'), $mother_info, 'phone_number');

       //      if ($mother['presentAddress']['country_id'] != '') {
       //          $presentAddress = Address::create($mother['presentAddress']);
       //          $mother_info->addresses()->attach($presentAddress->add_id);
       //      }

       //      $student->parents()->attach($mother_info->parent_id);
       //  }

       //  //GUARDIAN
       //  if ($guardian['lname'] != '' && $guardian['fname'] != '' && $guardian['mname'] != '') {
       //      //Format the names
       //      foreach ($guardian as $key => $value) {
       //          if($key == 'lname' || $key == 'fname' || $key == 'mname'){
       //              $guardian[$key] = ucfirst(strtolower($value));
       //          }
       //      }
       //      $guardian['deceased'] = 'no';
            
       //      $guardian_info = new Parents($guardian);
       //      $guardian_info->save();

       //      if ($guardian['presentAddress']['country_id'] != '') {
       //          $presentAddress = Address::create($guardian['presentAddress']);
       //          $guardian_info->addresses()->attach($presentAddress->add_id);
       //      }

       //      $student->parents()->attach($guardian_info->parent_id);
       //  }
       
       // foreach ($elementary as $key => $value) {
       //      if ($value['sch_name'] != '') {
       //          $info = new Elementary_Student($value);
       //          $student->elementarySchools()->save($info);

       //          if ($value['presentAddress']['country_id'] != '') {
       //              $presentAddress = Address::create($value['presentAddress']);
       //              $info->addresses()->attach($presentAddress->add_id);
       //          }
       //      }
       // }

       // foreach ($junior_high as $key => $value) {
       //      if ($value['sch_name'] != '') {
       //          $value['type'] = 'junior high';
       //          $info = new Hschool_Student($value);
       //          $student->highSchools()->save($info);

       //          if ($value['presentAddress']['country_id'] != '') {
       //              $presentAddress = Address::create($value['presentAddress']);
       //              $info->addresses()->attach($presentAddress->add_id);
       //          }
       //      }
       // }

       // foreach ($senior_high as $key => $value) {
       //      if ($value['sch_name'] != '') {
       //          $value['type'] = 'senior high';
       //          $info = new Hschool_Student($value);
       //          $student->highSchools()->save($info);

       //          if ($value['presentAddress']['country_id'] != '') {
       //              $presentAddress = Address::create($value['presentAddress']);
       //              $info->addresses()->attach($presentAddress->add_id);
       //          }
       //      }
       // }

       //  foreach ($vocational_record as $key => $value) {
       //      if ($value['sch_name'] != '') {
       //          $info = new Vocational_Record($value);
       //          $student->vocationalRecords()->save($info);

       //          if ($value['presentAddress']['country_id'] != '') {
       //              $presentAddress = Address::create($value['presentAddress']);
       //              $info->addresses()->attach($presentAddress->add_id);
       //          }
       //      }
       // }

       // foreach ($college as $key => $value) {
       //      if ($value['sch_name'] != '') {
       //          $info = new CollegeRecord($value);
       //          $student->collegeRecords()->save($info);

       //          if ($value['presentAddress']['country_id'] != '') {
       //              $presentAddress = Address::create($value['presentAddress']);
       //              $info->addresses()->attach($presentAddress->add_id);
       //          }
       //      }
       // }
  
        
       //  foreach ($eligibility as $elig) {
       //      if ($elig['type'] != '') {
       //          $eligibility_info = new Eligibility($elig);
       //          $student->eligibilities()->save($eligibility_info);
       //      }
       //  }
        
       //  foreach ($work_experience as $work) {
       //      if ($work['years_of_exp'] != '') {
       //          $work_experience_info = new WorkExperience($work);
       //          $student->workExperiences()->save($work_experience_info);
       //      }
       //  }

       //  foreach ($volunteers as $volunteer) {
       //      if ($volunteer['organization_name'] != '') {
       //          $volunter_info = new Volunteer($volunteer);
       //          $student->volunteers()->save($volunter_info);
       //      }
       //  }

       //  foreach ($trainings as $training) {
       //      if ($training['title'] != '') {
       //          $training_info = new Training($training);
       //          $student->trainings()->save($training_info);
       //      }
       //  }

       //  foreach ($others as $categQuestion) {
       //      foreach ($categQuestion['questions'] as $key => $value) {
       //          $answer = new QuestionAnswer($value);
       //          $student->answers()->save($answer);
       //      }
       //  }

       //  foreach ($references as $reference) {
       //      if ($reference['name'] != '') {
       //          $reference_info = new Reference($reference);
       //          $student->references()->save($reference_info);

       //          foreach ($reference['contact'] as $contact) {
       //              if ($contact['number'] != '') {
       //                  $contact_info = new ReferenceContactNumber($contact);
       //                  $reference_info->contact()->save($contact_info);
       //              }
       //          }
       //      }
       //  }

       //  foreach ($contactPersonInCaseOfEmergencies as $emergency) {
       //      if ($emergency['name'] != '') {
       //          $emergency_info = new ContactPerson($emergency);
       //          $student->ContactPersonInCaseOfEmergency()->save($emergency_info);

       //          foreach ($emergency['contact'] as $contact) {
       //              if ($contact['number'] != '') {
       //                  $contact_info = new ContactPersonNumber($contact);
       //                  $emergency_info->contact()->save($contact_info);
       //              }
       //          }
       //      }
       //  }

       //  return ['message' => 'Successfully Added'];
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
    public function update(CreateStudentInformationRequest $request, $id)
    {
        $date = new Carbon();
        $studentData = $request->input('student');
        $contacts = $studentData['contact'];
        $emails = $studentData['email'];
        $student_id = $studentData['student_id'];
        $primary_pic = $studentData['primaryselectedpic'];
        $childrens = $request->input('children');
        $father = $request->input('father');
        $mother = $request->input('mother');
        $guardian = $request->input('guardian');
        $elementary = $request->input('elementary');
        $junior_high = $request->input('junior_high');
        $senior_high = $request->input('senior_high');
        $vocational_record = $request->input('vocational_record');
        $college = $request->input('college');
        $eligibility = $request->input('eligibility');
        $work_experience = $request->input('work_experience');
        $volunteers = $request->input('volunteer');
        $trainings = $request->input('training');
        $others = $request->input('other');
        $references = $request->input('reference');
        $contactPersonInCaseOfEmergencies = $request->input('contactPersonInCaseOfEmergency');

        $student = StudentPersonalInfo::find($id)->load('studentSchoolInfo');
        $student->update($studentData);
        $student_copy = Student::where('spi_id', $student->spi_id)->first();

        // $student->addresses()->detach();
        $new_address = $student->addAddress($studentData['presentAddress'], 'presentAddress');
        if ($studentData['use_present_address'] == 'yes') {
            if ($studentData['permanentAddress']['add_id'] != '') {
                $address = S_Main_Address::where('spi_id', $student->spi_id)->where('add_id', $studentData['permanentAddress']['add_id'])->first();

                $address->update([
                    'add_id' => $studentData['presentAddress']['add_id'],
                    'use_present_address' => 'yes'
                ]);
            } else {
                $student->addresses()->attach($new_address->add_id, ['address_type' => 'permanentAddress', 'use_present_address' => 'yes']);
            }
        } else {
            $student->addAddress($studentData['permanentAddress'], 'permanentAddress');
        }

        
        

        $student_school_info = $student->studentSchoolInfo;
        $student_school_info->update([
            'stud_id' => $studentData['stud_id']
        ]);
        
        Session::put('student_school_info', $student_school_info);

        // $student->requirements()->detach();

        $student->addRequirements($studentData['requirements']);

        $student->addPhoneNumbers($contacts, $this, $request);

        $student->addEmail($emails, $this, $request);

        $student->addRequirements($studentData['requirements']);

        $student->addImage($primary_pic, $student_school_info);

        $student->addSchoolId($student_id, $student_school_info);

        $student->addChildren($childrens);
        
        $student->parents()->detach();

        $father = $student->addParent($father, 'Father', $this, $request, $new_address);

        $mother = $student->addParent($mother, 'Mother', $this, $request, $new_address);

        $student->addGuardian($guardian, $father, $mother, $this, $request);
       
        $student->addElementary($elementary);

        $student->addHighSchools($junior_high, 'junior high');

        $student->addHighSchools($senior_high, 'senior high');

        $student->addVocationalRecord($vocational_record);

        $student->collegeRecord($college);

        $student->addEligibility($eligibility);

        $student->addWorkExperience($work_experience);

        $student->addVolunteer($volunteers);

        $student->addTraining($trainings);

        $student->addSurveyAnswer($others);

        $student->addReference($references, $this, $request);

        $student->addContactPerson($contactPersonInCaseOfEmergencies, $this, $request);

        $student->studentSchoolInfo->addEnrollmentProcess(5);
        
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
        $folder_names = ['form137', 'gmc', 'high_school_card', 'honorable_dismissal', 'nso', 'tor'];
        $student = StudentPersonalInfo::find($id)->with('studentSchoolInfo')->first();
        $path_primary = 'images/student-info/photo/primary/'.$student->studentSchoolInfo->acct_no;
        $path_id = 'images/student-info/photo/id/'.$student->studentSchoolInfo->acct_no;

        

        if (file_exists($path_primary)) {
            array_map('unlink', glob("$path_primary/*.*"));
            rmdir($path_primary);
        }

        if (file_exists($path_id)) {
            array_map('unlink', glob("$path_id/*.*"));
            rmdir($path_id);
        }

        foreach ($folder_names as $folder_name) {
            $path_req = 'images/student-info/requirements/'. $folder_name .'/'.$student->studentSchoolInfo->acct_no;
            if (file_exists($path_req)) {
                array_map('unlink', glob("$path_req/*.*"));
                rmdir($path_req);
            }
        }
        
        $student = StudentPersonalInfo::find($id)->delete();

        return ['message' => 'Successfully Deleted'];
    }

    public function getColumn()
    {
        $student = StudentPersonalInfo::get()->toArray();
        $sam = array_keys((array)$student[0]);
        $student2[] = $sam[0];
        return ['student' => array_keys($student[0])];
    }

    public function addressInfo()
    {
        $address['regions'] = [];
        $address['provinces'] = [];
        $address['cities'] = [];
        $address['barangays'] = [];

        $countryId = $_GET['countryId'];
        $regionId = $_GET['regionId'];
        $provinceId = $_GET['provinceId'];
        $cityId = $_GET['cityId'];

        if ($countryId != '') {
            $address['regions'] = Region::where('country_id', $countryId)->get();
        }
        
        if ($regionId != '') {
            $address['provinces'] = Province::where('reg_id', $regionId)->get();
        }
        
        if ($provinceId != '') {
            $address['cities'] = City::where('province_id', $provinceId)->get();
        }
        
        if ($cityId != '') {
            $address['barangays'] = Barangay::where('city_id', $cityId)->orderBy('brgy_name', 'asc')->get();
        }

        if ($address) {
            return Response::json($address);
        } else {
            return [];
        }
        
    }

    public function insertAddress($info, $key, $person, $address_type)
    {
        $country = $key.'country';
        $province = $key.'province';
        $city = $key.'city';
        $barangay = $key.'barangay';
        $street = $key.'street';

        if ($person[$country] != '' && $person[$province] != '' && $person[$city] != '') {
            $address = new Address();
            $address->country_id = $person[$country];
            $address->province_id = $person[$province];
            $address->city_id = $person[$city];
            $address->brgy_id = $person[$barangay];
            $address->street = $person[$street];
            $address->save();

            if($address_type != ''){
                $info->addresses()->attach($address->add_id, ['address_type' => $address_type]);
            } else {
                $info->addresses()->attach($address->add_id);
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

    public function insertEducation($data, $type, $student_info)
    {
        $address_type = '';
        foreach ($data as $key => $value) {
            if ($value['sch_name'] != ''){

                if ($type == 'elementary') {

                    $info = new Elementary_Student($value);
                    $student_info->elementarySchools()->save($info);

                } else if ($type == 'junior_high' || $type == 'senior_high') {

                    $info = new Hschool_Student($value);
                    $info->type = 'senior high';
                    if ($type != 'senior_high') {
                        $address_type ='junior high';
                        $info->type = 'junior high';
                    }
                    $student_info->highSchools()->save($info);
                    $address_type ='senior high';
                    
                } else if ($type == 'vocational_record') {

                    $info = new Vocational_Record($value);
                    $student_info->vocationalRecords()->save($info);

                } else if ($type == 'college') {

                    $info = new CollegeRecord($value);
                    $student_info->collegeRecords()->save($info);

                }

                if ($value['pre_country'] != '') {
                    $this->insertAddress($info, 'pre_', $value, $address_type);
                }
            }
        }
    }


    public function insertContact($data, $info, $type)
    {
        if ($type == 'email') {
            foreach ($data as $email) {
                if ($email['email'] != '') {
                    $email = Email::create($email);
                    $info->emails()->attach($email->email_id);
                }
            }
        }

        if ($type == 'telephone_number') {
            foreach ($data as $telephone_number) {
                if ($telephone_number['telephone_number'] != '') {
                    $telephone_number = new TelephoneNumber($telephone_number);
                    $info->telephoneNumbers()->save($telephone_number);
                }
            }
        }

        if ($type == 'phone_number') {
            foreach ($data as $phone_number) {
                if ($phone_number['phone_number'] != '') {
                    $phone_number = PhoneNumber::create($phone_number);
                    $info->phoneNumbers()->attach($phone_number->phone_id);
                }
            }
        }
    }

    public function getAllStudentInfo()
    {
        $table_name = $_GET['tableName'];

        // $query = DB::table($table_name)->first();
         $query = StudentPersonalInfo::with('studentSchoolInfo.years', 'studentSchoolInfo.programs', 'requirements', 'addresses', 
                'studentSchoolInfo.scholarships')
            ->first();

        return response()->json($query);
    }

    public function program()
    {
        $program = $_GET['program'];
        $query = ProgramList::distinct()->select('major')->where('prog_name' ,$program)->get();

        return response()->json($query);
    }

    public function addressQuery()
    {
        $add_id = $_GET['add_id'];
        $country_id = $_GET['country_id'];
        $reg_id = $_GET['reg_id'];
        $province_id = $_GET['province_id'];
        $city_id = $_GET['city_id'];
        $brgy_id = $_GET['brgy_id'];
        $street = $_GET['street'];

        // $address = Address::where('add_id', $brgy_id)->with('province', 'city', 'barangay')->get();
        $address['regions'] = Region::where('country_id', $country_id)->get();
        $address['provinces'] = Province::where('reg_id', $reg_id)->get();
        $address['cities'] = City::where('province_id', $province_id)->get();
        $address['barangays'] = Barangay::where('city_id', $city_id)->get();

        $address['add_id'] = $add_id;
        $address['country_id'] = $country_id;
        $address['reg_id'] = $reg_id;
        $address['province_id'] = $province_id;
        $address['city_id'] = $city_id;
        $address['brgy_id'] = $brgy_id;
        $address['street'] = $street;

        return response()->json($address);




        // $id = $_GET['id'];
        // $type = $_GET['type'];
        // $address = [];

        // if ($type == 'country_id') {
        //     $address['regions'] = Region::where('country_id', $id)->get();
        // }

        // if ($type == 'reg_id') {
        //     $address['provinces'] = Province::where('reg_id', $id)->get();
        // }
        
        // if ($type == 'province_id') {
        //     $address['cities'] = City::where('province_id', $id)->get();
        // }
        
        // if ($type == 'city_id') {
        //     $address['barangays'] = Barangay::where('city_id', $id)->get();
        // }
        // if($address) {
        //     return response()->json($address);
        // } 
        // return [];
        
    }

    public function getQuestions()
    {
        $question_categories = QuestionCategory::with('questions')->get();

        return response()->json($question_categories);
    }

    public function getEnrolledStudents()
    {
        $student_id = $_GET['id'];
        $school_year = Date::getCurrentSchoolYear();
        $semester = Date::getCurrentSemester();

        $query = StudentPersonalInfo::with('studentSchoolInfo.studentType', 'studentImages', 'students.siblings.studentPersonalInfo.studentSchoolInfo.years', 
            'students.siblings.studentPersonalInfo.studentSchoolInfo.programs',
            'students.siblings.studentPersonalInfo.studentSchoolInfo.years',
            'students.siblings.studentPersonalInfo.studentImages')
            ->with(['studentSchoolInfo.years' => function ($query) use ($school_year, $semester) {
                $query->where('sch_year', '=', $school_year)
                        ->where('semester', '=', $semester);
            }])
            ->with(['studentSchoolInfo.programs' => function ($query) use ($school_year, $semester) {
                $query->where('sch_year', '=', $school_year)
                        ->where('semester', '=', $semester);
            }])
            ->with(['students.siblings.studentPersonalInfo.studentSchoolInfo.years' => function ($query) use ($school_year, $semester) {
                $query->where('sch_year', '=', $school_year)
                        ->where('semester', '=', $semester);
            }])
            ->with(['students.siblings.studentPersonalInfo.studentSchoolInfo.programs' => function ($query) use ($school_year, $semester) {
                $query->where('sch_year', '=', $school_year)
                        ->where('semester', '=', $semester);
            }])
            ->where('spi_id', $student_id)
            ->first();

        return response()->json($query);
    }

    public function addSibling(Request $request)
    {
        $student_spi = $request->input('student');
        $siblings = $request->input('siblings');
        $student_copy = Student::where('spi_id', $student_spi)->first();
        
        if (count($siblings)) {
            if (count($siblings) == 1) {
                foreach ($siblings as $value) {
                    $selectedSibling = Student::where('spi_id', $value['spi_id'])->first();
                    $sibling = new Sibling();
                    $sibling->stud_id = $selectedSibling->stud_id;
                    $sibling->spi_id = $student_spi;
                    $sibling->save();
                }
            }
            foreach ($siblings as $value) {
                $selectedSibling = Student::where('spi_id', $value['spi_id'])->first();

                foreach ($siblings as $value2) {
                    if ($selectedSibling->spi_id != $value2['spi_id']) {
                        $sibling = new Sibling();
                        $sibling->stud_id = $selectedSibling->stud_id;
                        $sibling->spi_id = $student_spi;
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
        }
        $siblings = Sibling::with([
            'studentPersonalInfo.studentImages',
            'studentPersonalInfo.studentSchoolInfo.years', 
            'studentPersonalInfo.studentSchoolInfo.programs', 
        ])
        ->where('stud_id', $student_copy->stud_id)
        ->get();

        return [
            'message' => 'Successfully Added',
            'siblings' => $siblings
        ];
    }

    public function removeSibling($id)
    {
        $sibling = Sibling::find($id);

        Sibling::where('stud_id', $sibling->stud_id)->where('spi_id', $sibling->spi_id)->delete();
        Sibling::where('stud_id', $sibling->spi_id)->where('spi_id', $sibling->stud_id)->delete();

        return ['message' => 'Successfully Deleted'];
    }

}





// class CustomArray
// {
//     public $id; 
//     public $value; 
//     function __construct($id, $value)
//     {
//         $this->id = $id;
//         $this->value = $value;
//     }
// }