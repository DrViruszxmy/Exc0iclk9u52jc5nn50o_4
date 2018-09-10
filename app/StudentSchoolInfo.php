<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Date;
use Carbon\Carbon;
class StudentSchoolInfo extends Model
{
    protected $connection = 'mysql';
    protected $table = "stud_sch_info";
    protected $primaryKey = "ssi_id";
    protected $fillable = ['stud_id', 'acct_no' , 'usn_no' , 'st_id'];


    public function studentPersonalInfo()
    {
    	return $this->belongsTo(StudentPersonalInfo::class, 'spi_id');
    }

    public function years()
    {
    	return $this->hasMany(Year::class, 'ssi_id');
    }

    public function studentType()
    {
    	return $this->belongsTo(StudentType::class, 'st_id');
    }

    public function studentPrograms()
    {
        return $this->hasMany(StudentProgram::class, 'ssi_id');
    }
  
    public function programs()
    {
        return $this->belongsToMany(ProgramList::class, 'stud_program', 'ssi_id', 'pl_id')
                    ->withTimestamps()
                    ->withPivot('sp_id', 'semester', 'sch_year');
    }

    public function scholarships()
    {
        return $this->belongsToMany(Scholarship_List::class, 'scholarship', 'ssi_id', 'sl_id')->withTimestamps();
        // return $this->hasMany(Scholarship::class, 'ssi_id');
    }

    public function studentEnrollmentStatus()
    {
        return $this->hasMany(studentEnrollmentStat::class, 'ssi_id');
    }

    public function uncreditedSubjects()
    {
        return $this->hasMany(UncreditedSubject::class, 'ssi_id');
    }

    public function curriculumUsed()
    {
        return $this->hasMany(Curr_Used::class, 'ssi_id');
    }

    public function enrolledSubjects()
    {
        return $this->hasMany(SubjectEnrolled::class, 'ssi_id');
    }

    public function ProgramsTaken()
    {
        return $this->hasMany(StudentProgramTaken::class, 'ssi_id');
    }

    public function enrollmentMode()
    {
        return $this->hasMany(EfsStudentMode::class, 'ssi_id');
    }


    public function subjectSuggests()
    {
        return $this->hasMany(SubjectSuggest::class, 'ssi_id');
    }

    public function addEnrollmentFlow($current_status, $level)
    {
        $enrollment_version = EfsVersion::with('classifications')
                            ->where('status', 'active')
                            ->where('student_type', $current_status)
                            ->where('level', $level)
                            ->first();

        if ($enrollment_version) {
            foreach ($enrollment_version->classifications as $step) {
                $this->enrollmentMode()->create([
                    'efc_id' => $step->pivot->efc_id,
                    'mode' => 'undone',
                    'sch_year' => Date::getCurrentSchoolYear(),
                    'semester' => Date::getCurrentSemester(),
                    'date' => Carbon::now(),
                ]);
            }

            // $this->enrollmentFlowStudentUsed()->create([
            //     'sch_year' => Date::getCurrentSchoolYear(),
            //     'semester' => Date::getCurrentSemester(),
            //     'date_used' => Carbon::now(),
            //     'efv_id' => $enrollment_version->efv_id
            // ]);
        }
    }

    public function addStudentEnrollmentStatus()
    {
        $this->studentEnrollmentStatus()->create([
            'status' => 'not enrolled',
            'sch_year' => Date::getCurrentSchoolYear(),
            'semester' => Date::getCurrentSemester(),
            'dated' => Carbon::now()
        ]);
    }

    public function addSchoolYear($student_data)
    {
        $student_data['sch_year'] = Date::getCurrentSchoolYear();
        $student_data['semester'] = Date::getCurrentSemester();

        $this->years()->create($student_data);
    }

    public function addProgram($student_data)
    {
        if ($student_data['major'] != '') {
            $program = ProgramList::with('curriculumCodeList')
                    ->where('prog_name', $student_data['program'])
                    ->where('major', $student_data['major'])
                    ->first();
        } else {
            $program = ProgramList::with('curriculumCodeList')->where('prog_name', $student_data['program'])->first();
        }

        $this->programs()->attach($program->pl_id, [
            'semester' => Date::getCurrentSemester(), 
            'sch_year' => Date::getCurrentSchoolYear()
        ]);

        return $program;
    }

    public function addCurriculum($program)
    {
        if (count($program->curriculumCodeList)) {
            $this->curriculumUsed()->create([
                'c_code' => $program->curriculumCodeList[0]->c_code,
                'semester' => Date::getCurrentSemester(), 
                'sch_year' => Date::getCurrentSchoolYear(),
                'status' => 'active'
            ]);

            return true;
        }
        return false;
    }

    public function addProgramTaken($program)
    {
        $this->ProgramsTaken()->create([
            'pl_id' => $program->pl_id,
            'stat_id' => 2,
            'semester' => Date::getCurrentSemester(), 
            'sch_year' => Date::getCurrentSchoolYear()
        ]);
    }

    public function addEnrollmentProcess($module_id)
    {
        $student_school_info = StudentSchoolInfo::with('enrollmentMode.classification.EnrollmentFlowSource')
            ->with(['enrollmentMode.classification.EnrollmentFlowSource' => function ($query) use ($module_id) {
                $query->where('mod_id', $module_id);
            }])
            ->where('ssi_id', $this->ssi_id)
            ->first();

        foreach ($student_school_info->enrollmentMode as $step) {
       
            if ($step->classification->EnrollmentFlowSource != null) {
                // 2 is Admission id portal
                EfsStudentMode::where('ssi_id', $student_school_info->ssi_id)
                    ->where('efc_id', $step->classification->efc_id) 
                    ->where('sch_year', Date::getCurrentSchoolYear())
                    ->where('semester', Date::getCurrentSemester())
                    ->update([
                        'mode' => 'done'
                    ]
                );
            }
        }
    }
}
