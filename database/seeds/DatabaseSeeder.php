<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

	/*protected $toTruncate = [
        'subject_enrolled', 'citizenship', 'stud_per_info', 'stud_sch_info', 'stud_type', 'year', 'relationship', 
        'parents', 'parents_student', 'department', 'program_list', 'stud_program', 'country',
        'prov', 'city', 'brgy', 'subject_enrolled_status', 'requirements_list', 'requirements', 'regions',
        'languages', 'Scholarship_List', 'address', 'student_enrollment_stat', 'stud_image', 'access_lists',
        'sub_module_lists', 'question_categories', 'questions', 'accessibilities', 'users', 'registered_users', 'usage_status',
        'activation_histories', 'siblings', 'student', 'school_lists', 'hschool_student', 'efs_student_modes', 'subject_suggests', 
        'emails', 'telephone_numbers', 'phone_numbers', 'elementary_student', 'work_experiences', 'volunters', 'eligibilities', 
        's_main_address', 'childrens', 'college_record', 'contact_people', 'contact_person_numbers', 'curr_used', 'ef_student_uses',
        'elementary_address', 'email_student', 'loghistories', 'parent_address', 'parent_phone', 'parent_telephones', 'references',
        'requirement_file_paths', 'scholarship', 'stud_prog_taken', 'stud_stat_list', 'stud_subject_logs', 'student_phone', 'trainings',
        'trans_history', 'transfer_logs', 'uncredited_subjects', 'vocational_record', 'vocational_record_address', 'enrollment_modules'
    ];*/

    protected $toTruncate = [
         'country', 'prov', 'city', 'brgy', 'regions'
    ];

    // protected $toTruncate = [
    //     'citizenship', 'stud_type', 'relationship', 
    //     'parents', 'parents_student', 'department', 'program_list', 'country',
    //     'prov', 'city', 'brgy', 'subject_enrolled_status', 'requirements_list', 'requirements', 'regions',
    //     'languages', 'Scholarship_List'
    // ];
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    	foreach ($this->toTruncate as $table) {
    		DB::table($table)->truncate();
    	}

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // $this->call(SchoolListTableSeeder::class);
        // $this->call(RelationshipTableSeeder::class);
        // $this->call(CitizenshipTableSeeder::class);
        // $this->call(StudentStatListSeeder::class);

        $this->call(CountryTableSeeder::class);
        $this->call(RegionTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(CityTableSeeder::class);

        $this->call(BarangayTableSeeder::class);

        // $this->call(RequirementListTableSeeder::class);
        // $this->call(StudTypeTableSeeder::class);
        // $this->call(DepartmentTableSeeder::class);
        // $this->call(ProgramListTableSeeder::class);
        // $this->call(SubjectEnrolledStatusTableSeeder::class);

        // $this->call(EnrollmentModuleSeeder::class);
        // $this->call(StudPerInfoTableSeeder::class);
        // $this->call(ScholarshipListTableSeeder::class);
        // $this->call(AccessListSeeder::class);
        // $this->call(SurveyQuestionSeeder::class);
 














        // $this->call(ScholarshipTableSeeder::class);
        // $this->call(StudentProgramTableSeeder::class);

        // $this->call(StudSchInfoTableSeeder::class);
        
        // $this->call(SubjectEnrolledTableSeeder::class);
        // $this->call(YearTableSeeder::class);
        // $this->call(DepartmentTableSeeder::class);
        // $this->call(ProgramListTableSeeder::class);
        // $this->call(ParentsTableSeeder::class);
        // $this->call(ParentsStudentTableSeeder::class);
        // $this->call(StudentProgramTableSeeder::class);
       
        
        // $this->call(RequirementTableSeeder::class);
        
        
        // $this->call(LanguageTableSeeder::class);
        
        

    }
}
