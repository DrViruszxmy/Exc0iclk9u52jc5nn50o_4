<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Student;
use App\SchoolList;
use App\Children;
use Carbon\Carbon;
use File;

class StudentPersonalInfo extends Model
{
    protected $connection = 'mysql';
    protected $table = "stud_per_info";
    protected $primaryKey = "spi_id";
    protected $fillable = ['fname', 'mname', 'lname', 'suffix', 'birthdate', 'birthplace','gender', 'civ_status', 'blood_type', 'weight', 'height', 'cit_id', 'religion'];

    public function setFnameAttribute($fname)
    {
        $this->attributes['fname'] = ucfirst(strtolower($fname));
    }

    public function setMnameAttribute($mname)
    {
        $this->attributes['mname'] = ucfirst(strtolower($mname));
    }

    public function setLnameAttribute($lname)
    {
        $this->attributes['lname'] = ucfirst(strtolower($lname));
    }

    public function getLNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class, 's_main_address', 'spi_id', 'add_id')->withTimestamps()
                ->withPivot('address_type', 'use_present_address');
    }

    public function citizenship()
    {
    	return $this->belongsTo(Citizenship::class, 'cit_id');
    }

    public function childrens()
    {
        return $this->hasMany(Children::class, 'spi_id');
    }

    public function eligibilities()
    {
        return $this->hasMany(Eligibility::class, 'spi_id');
    }

    public function elementarySchools()
    {
        return $this->hasMany(Elementary_Student::class, 'spi_id');
    }

    public function highSchools()
    {
        return $this->hasMany(Hschool_Student::class, 'spi_id');
    }

    public function vocationalRecords()
    {
        return $this->hasMany(Vocational_Record::class, 'spi_id');
    }

    public function collegeRecords()
    {
        return $this->hasMany(CollegeRecord::class, 'spi_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_student', 'spi_id', 'language_id')->withTimestamps();
    }

    public function studentSchoolInfo()
    {
    	return $this->hasOne(StudentSchoolInfo::class, 'spi_id');
    }

   	public function parents()
    {
    	return $this->belongsToMany(Parents::class, 'parents_student', 'spi_id', 'parent_id')->withPivot('rel_id');
    }

    public function studentParents()
    {
        return $this->hasMany(Parents_Student::class, 'spi_id');
    }

    public function studentImages()
    {
        return $this->hasMany(StudentImage::class, 'spi_id');
    }

    public function siblings()
    {
        return $this->hasMany(Sibling::class, 'spi_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'spi_id');
    }

    public function requirements()
    {
        return $this->belongsToMany(Requirement_List::class, 'requirements', 'spi_id', 'rl_id')->withTimestamps();
        // return $this->hasMany(Requirement::class, 'spi_id');
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'email_student', 'spi_id', 'email_id')->withTimestamps();
        // return $this->hasMany(Email::class, 'spi_id');
    }

    public function telephoneNumbers()
    {
        return $this->hasMany(TelephoneNumber::class, 'spi_id');
    }

    public function phoneNumbers()
    {
        return $this->belongsToMany(PhoneNumber::class, 'student_phone', 'spi_id', 'phone_id')->withTimestamps();
        // return $this->hasMany(PhoneNumber::class, 'spi_id');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class, 'spi_id');
    }

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class, 'spi_id');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class, 'spi_id');
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class, 'spi_id');
    }

    public function references()
    {
        return $this->hasMany(Reference::class, 'spi_id');
    }

    public function ContactPersonInCaseOfEmergency()
    {
        return $this->hasMany(ContactPerson::class, 'spi_id');
    }

    public function copyStudentPersonalInfo()
    {
       return $this->students()->create([]);
    }

    public function addSchoolInfo($student_id, $enrollee_type)
    {
        return $this->studentSchoolInfo()->create([
            'stud_id' => $student_id,
            'usn_no' => $this->generateAccountNo(),
            'acct_no' => $this->generateAccountNo(),
            'st_id' => $enrollee_type
        ]);
    }

    public function addPhoneNumbers($contacts, $self, $request)
    {
        $messages = array(
            'student.contact.*.phone_number.unique' => 'This contact no. has already been taken.',
            'student.contact.*.phone_number.regex' => 'Must be a valid contact number. Ex. 09091234567',
        );
        $this->phoneNumbers()->delete();
        if (count($contacts)) {
            $self->validate($request, [
                'student.contact.*.phone_number' => 'nullable|regex:/^(09)[0-9]{9}$/|unique:phone_numbers'
            ], $messages);

            foreach ($contacts as $contact) {
                $check_phone = PhoneNumber::where('phone_number', $contact['phone_number'])->first();

                if (! $check_phone) {
                    if ($contact['phone_number'] != '') {
                        $contact = PhoneNumber::create($contact);
                        $this->phoneNumbers()->attach($contact->phone_id);
                    }
                }
                
            }  
        }
    }

    public function addEmail($emails, $self, $request)
    {
        $this->emails()->delete();
        if (count($emails)) {
            $messages = array(
                'student.email.*.email.unique' => 'This email has already been taken.',
                'student.email.*.email.email' => 'Must be a valid email address.',
            );
            $self->validate($request, [
                'student.email.*.email' => 'nullable|email|unique:emails'
            ], $messages);

            foreach ($emails as $email) {
                $check_email = Email::where('email', $email['email'])->first();

                if (! $check_email) {
                    if ($email['email'] != '') {
                        $email = Email::create($email);
                        $this->emails()->attach($email->email_id);
                    }
                }
                
            }  
        }
    }

    public function addChildren($childrens)
    {
        Children::where('spi_id', $this->spi_id)->delete();
        foreach ($childrens as $children) {
            if ($children['full_name'] != '') {
                $children_info = new Children($children);
                $this->childrens()->save($children_info);
            }
        }
    }

    public function addParent($parent, $type, $self, $request, $new_address)
    {
        if ($parent['lname'] != '' && $parent['fname'] != '') {
            $address = [];

            if ($parent['deceased'] == false) {
                $parent['deceased'] = 'no';
            } else {
                $parent['deceased'] = 'yes';
            }

            $relationship = Relationship::where('relationship', $type)->where('type_of_rel', 'parent')->first(); 

            $parent_info = Parents::where('fname', $parent['fname'])
                    ->where('lname', $parent['lname'])
                    ->first();

            if (! $parent_info) {
                $parent_info = new Parents($parent);
                $parent_info->save();
            } else {
                $parent_info->update($parent);
            }

            $this->parents()->attach($parent_info->parent_id, ['rel_id' => $relationship->rel_id]);
            
            $parent_phone = $parent_info->load('phoneNumbers');
            if ($parent_phone->phoneNumbers) {
                foreach ($parent_phone->phoneNumbers as $value) {
                    PhoneNumber::find($value->phone_id)->delete();
                }
            }

            if (count($parent['contact'])) {
                $parent_info->phoneNumbers()->delete();
                if ($type == 'Father') {
                    $messages = array(
                        'father.contact.*.phone_number.unique' => 'This contact no. has already been taken.',
                        'father.contact.*.phone_number.regex' => 'Must be a valid contact number. Ex. 09091234567',
                    );

                    $self->validate($request, [
                        'father.contact.*.phone_number' => 'nullable|regex:/^(09)[0-9]{9}$/|unique:phone_numbers'
                    ], $messages);
                } else {
                    $messages = array(
                        'mother.contact.*.phone_number.unique' => 'This contact no. has already been taken.',
                        'mother.contact.*.phone_number.regex' => 'Must be a valid contact number. Ex. 09091234567',
                    );
                    $self->validate($request, [
                        'mother.contact.*.phone_number' => 'nullable|regex:/^(09)[0-9]{9}$/|unique:phone_numbers'
                    ], $messages);
                }
                

                // $parent_info->phoneNumbers()->detach();
                foreach ($parent['contact'] as $contact) {
                    $check_phone = PhoneNumber::where('phone_number', $contact['phone_number'])->first();

                    if (! $check_phone) {
                        if ($contact['phone_number'] != '') {
                            $contact = PhoneNumber::create($contact);
                            $parent_info->phoneNumbers()->attach($contact->phone_id);
                        }
                    }
                    
                }  
            }

            //telephone
            $parent_phone = $parent_info->load('telephoneNumbers');
            if ($parent_phone->telephoneNumbers) {
                foreach ($parent_phone->telephoneNumbers as $value) {
                    TelephoneNumber::find($value->telephone_id)->delete();
                }
            }
            
            $parent_info->telephoneNumbers()->detach();
            if (count($parent['telephone'])) {
                if ($type == 'Father') {
                    $messages = array(
                        'father.telephone.*.telephone_number.unique' => 'This telephone no. has already been taken.',
                        'father.telephone.*.telephone_number.regex' => 'Must be a valid telephone number. Ex. 815-2607',
                    );
                    $self->validate($request, [
                        'father.telephone.*.telephone_number' => 'nullable|regex:/([1-9]\d{2})([- .])(\d{4})$/|unique:telephone_numbers'
                    ], $messages);
                } else {
                    $messages = array(
                        'mother.telephone.*.telephone_number.unique' => 'This telephone no. has already been taken.',
                        'mother.telephone.*.telephone_number.regex' => 'Must be a valid telephone number. Ex. 815-2607',
                    );
                    $self->validate($request, [
                        'mother.telephone.*.telephone_number' => 'nullable|regex:/([1-9]\d{2})([- .])(\d{4})$/|unique:telephone_numbers'
                    ], $messages);
                }
                

                foreach ($parent['telephone'] as $telephone) {
                    $check_phone = TelephoneNumber::where('telephone_number', $telephone['telephone_number'])->first();

                    if (! $check_phone) {
                        if ($telephone['telephone_number'] != '') {
                            $telephone = TelephoneNumber::create($telephone);
                            $parent_info->telephoneNumbers()->attach($telephone->telephone_id);
                        }
                    }
                    
                }  
            }


            $parent_info->addresses()->detach();

            if ($parent['use_present_address'] == 'yes') {
                if ($new_address['country_id'] != '') {
                    $parent_info->addresses()->attach($new_address->add_id, ['use_present_address' => 'yes']);
                    $address = $new_address;
                } 
            } else {
                if ($parent['presentAddress']['country_id'] != '') {
                    $presentAddress = Address::create($parent['presentAddress']);
                    $parent_info->addresses()->attach($presentAddress->add_id, ['use_present_address' => 'no']);

                    $address = $parent['presentAddress'];
                } 
            }

            return $address;
        }
    }

    public function addGuardian($guardian, $fatherAddress, $motherAddress, $self, $request)
    {
        if ($guardian['lname'] != '' && $guardian['fname'] != '' && $guardian['mname'] != '') {
            $guardian['deceased'] = 'no';

            if ($guardian['new_relation'] != '') {

                $relationship = Relationship::updateOrCreate([
                    'relationship' => $guardian['new_relation'],
                    'type_of_rel' => 'guardian'
                ]);
            } else {
                $relationship = Relationship::where('relationship', $guardian['rel_id'])->where('type_of_rel', 'guardian')->first(); 
            }
            
            $guardian_info = Parents::where('fname', $guardian['fname'])
                    ->where('mname', $guardian['mname'])
                    ->where('lname', $guardian['lname'])
                    ->first();

            if (! $guardian_info) {
                $guardian_info = new Parents($guardian);
                $guardian_info->save();
            } 

            $this->parents()->attach($guardian_info->parent_id, ['rel_id' => $relationship->rel_id]);

            if ($guardian['rel_id'] != 'Father' && $guardian['rel_id'] != 'Mother') {
                //phone
                $parent_phone = $guardian_info->load('phoneNumbers');
                if ($parent_phone->phoneNumbers) {
                    foreach ($parent_phone->phoneNumbers as $value) {
                        PhoneNumber::find($value->phone_id)->delete();
                    }
                }

                if (count($guardian['contact'])) {
                    $messages = array(
                        'guardian.contact.*.phone_number.unique' => 'This contact no. has already been taken.',
                        'guardian.contact.*.phone_number.regex' => 'Must be a valid contact number. Ex. 09091234567',
                    );
                    $self->validate($request, [
                        'guardian.contact.*.phone_number' => 'nullable|regex:/^\+?[^a-zA-Z]{4,}$/|unique:phone_numbers'
                    ], $messages);
                    

                    foreach ($guardian['contact'] as $contact) {
                        $check_phone = PhoneNumber::where('phone_number', $contact['phone_number'])->first();

                        if (! $check_phone) {
                            if ($contact['phone_number'] != '') {
                                $contact = PhoneNumber::create($contact);
                                $guardian_info->phoneNumbers()->attach($contact->phone_id);
                            }
                        }
                        
                    }  
                }

                //telephone
                $guardian_phone = $guardian_info->load('telephoneNumbers');
                if ($guardian_phone->telephoneNumbers) {
                    foreach ($guardian_phone->telephoneNumbers as $value) {
                        TelephoneNumber::find($value->telephone_id)->delete();
                    }
                }
                
                if (count($guardian['telephone'])) {
                    $messages = array(
                        'guardian.telephone.*.telephone_number.unique' => 'This telephone no. has already been taken.',
                        'guardian.telephone.*.telephone_number.regex' => 'Must be a valid telephone number. Ex. 815-2607',
                    );
                    $self->validate($request, [
                        'guardian.telephone.*.telephone_number' => 'nullable|regex:/([1-9]\d{2})([- .])(\d{4})$/|unique:telephone_numbers'
                    ], $messages);
                    

                    foreach ($guardian['telephone'] as $telephone) {
                        $check_phone = TelephoneNumber::where('telephone_number', $telephone['telephone_number'])->first();

                        if (! $check_phone) {
                            if ($telephone['telephone_number'] != '') {
                                $telephone = TelephoneNumber::create($telephone);
                                $guardian_info->telephoneNumbers()->attach($telephone->telephone_id);
                            }
                        }
                    }  
                }

                // address
                $guardian_info->addresses()->detach();
                if ($guardian['presentAddress']['country_id'] != '') {
                    $presentAddress = Address::create($guardian['presentAddress']);
                    $guardian_info->addresses()->attach($presentAddress->add_id, ['use_present_address' => 'none']);
                } 
            }
        }
    }

    public function addSchoolId($student_id, $student_school_info)
    {

        if ($student_id != 'public/images/avatar5.png') {
            $filteredData = explode(',', $student_id);

            if (count($filteredData) > 1) {
                //Create the image 
                $name = time() . $student_school_info->acct_no.'.png';
                $path = 'public/images/student-info/photo/id/'.$student_school_info->acct_no;
                $file_path = 'public/images/student-info/photo/id/'.$student_school_info->acct_no.'/'.$name;
                if (!File::exists($path)) {
                    mkdir($path, 0777);
                } 
                $fp = fopen($file_path, 'w+');
                $unencoded = base64_decode($filteredData[1]);
                fwrite($fp, $unencoded);
                fclose($fp); 

                $this->studentImages()->create([
                    'image_path' => $file_path,
                    'image_name' => $student_school_info->acct_no.'.png',
                    'type' => 'id'
                ]);
            }
        }
    }
    public function addImage($primary_pic, $student_school_info)
    {
        if ($primary_pic != 'public/images/control-panel/account-management/ssg/user-logo.fw.png') {
            $filteredData = explode(',', $primary_pic);
            
            if (count($filteredData) > 1) {
                $path = 'public/images/student-info/photo/primary/'.$student_school_info->acct_no;
                $file_path = 'public/images/student-info/photo/primary/'.$student_school_info->acct_no.'/'.$student_school_info->acct_no.'.png';
                if (!File::exists($path)) {
                    mkdir($path, 0777);
                } 

                $fp = fopen($file_path, 'w+');
                $unencoded = base64_decode($filteredData[1]);
                fwrite($fp, $unencoded);
                fclose($fp); 

                StudentImage::where('spi_id', $this->spi_id)->delete();

                $this->studentImages()->create([
                    'image_path' => $file_path,
                    'image_name' => $student_school_info->acct_no.'.png',
                    'type' => 'primary'
                ]);
            }
        }
    }

    public function addRequirements($requirements)
    {
        if (count($requirements)) {
            $this->requirements()->detach();
            foreach ($requirements as $value) {
                if ($value['check'] == true) {
                    $this->requirements()->attach($value['id'], ['quantity' => '1', 'date' => Carbon::now()]);
                }
            }
        }
    }

    public function addAddress($address, $type)
    {
        $new_address = "";
        if ($address['country_id'] != '') {
            if ($address['add_id'] != '') {
                $new_address = Address::find($address['add_id']);
                $new_address->update($address);


            } else {
                $new_address = Address::create($address);
                $this->addresses()->attach($new_address->add_id, ['address_type' => $type, 'use_present_address' => 'no']);
            }
        }

        return $new_address;
    }

    public function addElementary($elementary)
    {
        foreach ($elementary as $key => $value) {
            if ($value['sch_name'] != '') {
                $school = SchoolList::where('school_name', $value['sch_name'])->where('category', 'elementary')->first();

                if (! $school) {
                    $school = SchoolList::create([
                        'school_name' => $value['sch_name'],
                        'category' => 'elementary',
                    ]);

                    $value['sl_id'] = $school->sl_id;
                    if ($value['elementary_id'] != '') {
                        $info = Elementary_Student::find($value['elementary_id']);
                        $info->update($value);
                    } else {
                        $info = new Elementary_Student($value);
                        $this->elementarySchools()->save($info);
                    }
                    
                    

                    if ($value['presentAddress']['country_id'] != '') {
                        if ($value['presentAddress']['add_id'] != '') {
                            Address::find($value['presentAddress']['add_id'])->update($value['presentAddress']);
                        } else {
                            $presentAddress = Address::create($value['presentAddress']);
                            $info->addresses()->attach($presentAddress->add_id);
                        }
                    }
                } else {
                    $value['sl_id'] = $school->sl_id;
                    if ($value['elementary_id'] != '') {
                        $info = Elementary_Student::find($value['elementary_id']);
                        $info->update($value);
                    } else {
                        $info = new Elementary_Student($value);
                        $this->elementarySchools()->save($info);
                    }

                    if ($value['presentAddress']['country_id'] != '') {
                        if ($value['presentAddress']['add_id'] != '') {
                            Address::find($value['presentAddress']['add_id'])->update($value['presentAddress']);
                        } else {
                            $presentAddress = Address::create($value['presentAddress']);
                            $info->addresses()->attach($presentAddress->add_id);
                        }
                    }
                }
            } else {
                if ($value['elementary_id'] != '') {
                    $info = Elementary_Student::find($value['elementary_id'])->delete();
                }
            }
       }
    }

    public function addHighSchools($schools, $type)
    {
        if (count($schools)) {
            $new_type = '';
            if ($type == 'junior high') {
                $new_type = 'junior_high';
            } else {
                $new_type = 'senior_high';
            }
            
            foreach ($schools as $key => $value) {
                if ($value['sch_name'] != '') {
                    $school = SchoolList::where('school_name', $value['sch_name'])->where('category', $new_type)->first();

                    if (! $school) {
                        $school = SchoolList::create([
                            'school_name' => $value['sch_name'],
                            'category' => $new_type,
                        ]);

                        $value['sl_id'] = $school->sl_id;
                        $value['type'] = $type;

                        $year = explode('-', $value['sch_year']);

                        
                        if ($value['hss_id'] != '') {
                            $info = Hschool_Student::find($value['hss_id']);
                            $info->update($value);
                        } else {
                            $info = new Hschool_Student($value);
                            $this->highSchools()->save($info);
                        }

                        

                        if ($value['presentAddress']['country_id'] != '') {
                            if ($value['presentAddress']['add_id'] != '') {
                                Address::find($value['presentAddress']['add_id'])->update($value['presentAddress']);
                            } else {
                                $presentAddress = Address::create($value['presentAddress']);
                                $info->addresses()->attach($presentAddress->add_id);
                            }
                        }
                    } else {
                        $value['sl_id'] = $school->sl_id;
                        $value['type'] = $type;
                        
                        if ($value['hss_id'] != '') {
                            $info = Hschool_Student::find($value['hss_id']);
                            $info->update($value);
                        } else {
                            $info = new Hschool_Student($value);
                            $this->highSchools()->save($info);
                        }

                        if ($value['presentAddress']['country_id'] != '') {
                            if ($value['presentAddress']['add_id'] != '') {
                                Address::find($value['presentAddress']['add_id'])->update($value['presentAddress']);
                            } else {
                                $presentAddress = Address::create($value['presentAddress']);
                                $info->addresses()->attach($presentAddress->add_id);
                            }
                        }
                    }
                } else {
                    if ($value['hss_id'] != '') {
                        $info = Hschool_Student::find($value['hss_id'])->delete();
                    }
                }
            }
        }
    }

    public function addVocationalRecord($vocational_record)
    {
        foreach ($vocational_record as $key => $value) {
            if ($value['sch_name'] != '') {
                $school = SchoolList::where('school_name', $value['sch_name'])->where('category', 'vocational_record')->first();

                if (! $school) {
                    $school = SchoolList::create([
                        'school_name' => $value['sch_name'],
                        'category' => 'vocational_record',
                    ]);

                    $value['sl_id'] = $school->sl_id;
                    
                    if ($value['vr_id'] != '') {
                        $info =  Vocational_Record::find($value['vr_id']);
                        $info->update($value);
                    } else {
                        $info = new Vocational_Record($value);
                        $this->vocationalRecords()->save($info);
                    }
                    

                    if ($value['presentAddress']['country_id'] != '') {
                        if ($value['presentAddress']['add_id'] != '') {
                            Address::find($value['presentAddress']['add_id'])->update($value['presentAddress']);
                        } else {
                            $presentAddress = Address::create($value['presentAddress']);
                            $info->addresses()->attach($presentAddress->add_id);
                        }
                    }
                } else {
                    $value['sl_id'] = $school->sl_id;
                    if ($value['vr_id'] != '') {
                        $info =  Vocational_Record::find($value['vr_id']);
                        $info->update($value);
                    } else {
                        $info = new Vocational_Record($value);
                        $this->vocationalRecords()->save($info);
                    }

                    if ($value['presentAddress']['country_id'] != '') {
                        if ($value['presentAddress']['add_id'] != '') {
                            Address::find($value['presentAddress']['add_id'])->update($value['presentAddress']);
                        } else {
                            $presentAddress = Address::create($value['presentAddress']);
                            $info->addresses()->attach($presentAddress->add_id);
                        }
                    }
                }
            }
       }
    }

    public function collegeRecord($college)
    {
        foreach ($college as $key => $value) {
            if ($value['sch_name'] != '') {


                $school = SchoolList::where('school_name', $value['sch_name'])->where('category', 'college')->first();

                if (! $school) {
                    $school = SchoolList::create([
                        'school_name' => $value['sch_name'],
                        'category' => 'college',
                    ]);

                    $value['sl_id'] = $school->sl_id;

                    if ($value['cr_id'] != '') {
                        $info = CollegeRecord::find($value['cr_id']);
                        $info->update($value);
                    } else {
                        $info = new CollegeRecord($value);
                        $this->collegeRecords()->save($info);
                    }

                    if ($value['presentAddress']['country_id'] != '') {
                        if ($value['presentAddress']['add_id'] != '') {
                            Address::find($value['presentAddress']['add_id'])->update($value['presentAddress']);
                        } else {
                            $presentAddress = Address::create($value['presentAddress']);
                            $info->addresses()->attach($presentAddress->add_id);
                        }
                    }
                } else {
                    $value['sl_id'] = $school->sl_id;
                    if ($value['cr_id'] != '') {
                        $info = CollegeRecord::find($value['cr_id']);
                        $info->update($value);
                    } else {
                        $info = new CollegeRecord($value);
                        $this->collegeRecords()->save($info);
                    }

                    if ($value['presentAddress']['country_id'] != '') {
                        if ($value['presentAddress']['add_id'] != '') {
                            Address::find($value['presentAddress']['add_id'])->update($value['presentAddress']);
                        } else {
                            $presentAddress = Address::create($value['presentAddress']);
                            $info->addresses()->attach($presentAddress->add_id);
                        }
                    }
                }
            } else {
                if ($value['sch_name'] == '') {
                    if ($value['cr_id'] != '') {
                        CollegeRecord::find($value['cr_id'])->delete();
                    }
                }
            }
       }
    }

    public function addEligibility($eligibility)
    {
        foreach ($eligibility as $elig) {
            if ($elig['type'] != '') {
                if ($elig['eligibility_id'] != '') {
                    Eligibility::find($elig['eligibility_id'])->update($elig);
                } else {
                    $eligibility_info = new Eligibility($elig);
                    $this->eligibilities()->save($eligibility_info);
                }
            }
        }
    }

    public function addWorkExperience($work_experience)
    {
        foreach ($work_experience as $work) {
            if ($work['years_of_exp'] != '') {

                if ($work['work_exp_id'] != '') {
                    WorkExperience::find($work['work_exp_id'])->update($work);
                } else {
                    $work_experience_info = new WorkExperience($work);
                    $this->workExperiences()->save($work_experience_info);
                }
                
            }
        }    
    }

    public function addVolunteer($volunteers)
    {
        foreach ($volunteers as $volunteer) {
            if ($volunteer['organization_name'] != '') {

                if ($volunteer['volunter_id'] != '') {
                    Volunteer::find($volunteer['volunter_id'])->update($volunteer);
                } else {
                    $volunter_info = new Volunteer($volunteer);
                    $this->volunteers()->save($volunter_info);
                }
                
            }
        }
    }

    public function addTraining($trainings)
    {
        foreach ($trainings as $train) {
            if ($train['title'] != '') {

                if ($train['training_id'] != '') {
                    Training::find($train['training_id'])->update($train);
                } else {
                    $training_info = new Training($train);
                    $this->trainings()->save($training_info);
                }

            }
        }
    }

    public function addSurveyAnswer($others)
    {
        $this->answers()->delete();

        foreach ($others as $categQuestion) {
            foreach ($categQuestion['questions'] as $key => $value) {
                if ($value['answer'] != '') {
                    $answer = new QuestionAnswer($value);
                    $this->answers()->save($answer);
                }
            }
        }
    }

    public function addReference($references, $self, $request)
    {
        foreach ($references as $reference) {
            if ($reference['name'] != '') {

                if ($reference['reference_id'] != '') {
                    $reference_info = Reference::find($reference['reference_id']);
                    $reference_info->update($reference);
                } else {
                    $reference_info = new Reference($reference);
                    $this->references()->save($reference_info);
                }

                //phone
                $reference_phone = $reference_info->load('contact');
                if ($reference_phone->contact) {
                    foreach ($reference_phone->contact as $value) {
                        ReferenceContactNumber::find($value->reference_num_id)->delete();
                    }
                }

                if (count($reference['contact'])) {
                    $messages = array(
                        'reference.contact.*.number.unique' => 'This contact no. has already been taken.',
                        'reference.contact.*.number.regex' => 'Must be a valid contact number. Ex. 09091234567',
                    );
                    $self->validate($request, [
                        'reference.contact.*.number' => 'nullable|regex:/^(09)[0-9]{9}$/|unique:reference_contact_numbers'
                    ], $messages);
                


                    foreach ($reference['contact'] as $contact) {
                        $check_phone = ReferenceContactNumber::where('number', $contact['number'])->first();

                        if (! $check_phone) {
                            if ($contact['number'] != '') {
                                $contact = new ReferenceContactNumber($contact);
                                $reference_info->contact()->save($contact);
                            }
                        }
                        
                    }  
                }

            }
        }
    }

    public function addContactPerson($contactPersonInCaseOfEmergencies, $self, $request)
    {
        foreach ($contactPersonInCaseOfEmergencies as $emergency) {
            if ($emergency['name'] != '') {

                if ($emergency['contact_person_id'] != '') {
                    $emergency_info = ContactPerson::find($emergency['contact_person_id']);
                    $emergency_info->update($emergency);
                } else {
                    $emergency_info = new ContactPerson($emergency);
                    $this->ContactPersonInCaseOfEmergency()->save($emergency_info);
                }

                if (count($emergency['contact'])) {
                    $messages = array(
                        'contactPersonInCaseOfEmergency.contact.*.number.unique' => 'This contact no. has already been taken.',
                        'contactPersonInCaseOfEmergency.contact.*.number.regex' => 'Must be a valid contact number. Ex. 09091234567',
                    );
                    $self->validate($request, [
                        'contactPersonInCaseOfEmergency.contact.*.number' => 'nullable|regex:/^(09)[0-9]{9}$/|unique:contact_person_numbers'
                    ], $messages);
                


                    foreach ($emergency['contact'] as $contact) {
                        $check_phone = ContactPersonNumber::where('number', $contact['number'])->first();

                        if (! $check_phone) {
                            if ($contact['number'] != '') {
                                $contact = new ContactPersonNumber($contact);
                                $emergency_info->contact()->save($contact);
                            }
                        }
                        
                    }  
                }

                // foreach ($emergency['contact'] as $contact) {
                //     if ($contact['number'] != '') {
                //         $contact_info = new ContactPersonNumber($contact);
                //         $emergency_info->contact()->save($contact_info);
                //     }
                // }
            }
        }
    }

    public static function generateAccountNo()
    {
        $date = Carbon::now();
        $str = explode('20', $date->year);
        $last_digit_year = $str[1];

        $first_key = $last_digit_year .'-'. $date->month;
        $pool = '0123456789';
        $length = 16;
        $id =  $first_key.'-'.substr(str_shuffle(str_repeat($pool, $length)), -6, $length);

        return $id;
    }

    public static function generateCreditCode()
    {
        $date = Carbon::now();

        $first_key = 'CRD-'. $date->month;
        $pool = '0123456789';
        $length = 16;
        $id =  $first_key.'-'.substr(str_shuffle(str_repeat($pool, $length)), -4, $length);

        return $id;
    }

    public static function generateShortCourseCode()
    {
        $date = Carbon::now();

        $first_key = 'SC'. $date->month. $date->day;
        $pool = '0123456789';
        $length = 16;
        $id =  $first_key.''.substr(str_shuffle(str_repeat($pool, $length)), -2, $length);

        return $id;
    }
}
