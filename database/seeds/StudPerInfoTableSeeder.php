<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
class StudPerInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        
        $students = factory('App\StudentPersonalInfo', 0)->create();
        $school_info = factory('App\StudentSchoolInfo', 10)->create();

        $school_info->each(function ($student) {
            factory('App\Hschool_Student', 1)->create(['spi_id' => $student->spi_id]);
            factory('App\Requirement', 3)->create(['spi_id' => $student->spi_id]);

       
            $years = factory('App\Year', 1)->create(['ssi_id' => $student->ssi_id]);
            factory('App\Curr_Used', 1)->create(['ssi_id' => $student->ssi_id]);
            // factory('App\EfStudentUse', 1)->create(['ssi_id' => $student->ssi_id]);
            // factory('App\EfsStudentMode', 1)->create(['ssi_id' => $student->ssi_id]);

            App\Student::create([
                'spi_id' => $student->spi_id,
            ]);

            // $step = 1;
            // while ($step <= 6) {
                
            //     App\EfsStudentMode::create([
            //         'ssi_id' => $student->ssi_id,
            //         'efc_id' => $step,
            //         'mode' => 'undone',
            //         'date' => new Carbon(),
            //     ]);
            //     $step++;
            // }
            
            $years->each(function ($year) use ($student) {
                factory('App\StudentProgram')->create([
                    'ssi_id' => $student->ssi_id, 
                    'sch_year' => $year->sch_year,
                    'semester' => $year->semester
                ]);
                factory('App\StudentEnrollmentStat')->create([
                    'ssi_id' => $student->ssi_id,
                    'sch_year' => $year->sch_year,
                    'semester' => $year->semester
                ]);
            });






            // factory('App\SubjectEnrolled', 5)->create(['ssi_id' => $student->ssi_id]);

            // $address = factory('App\Address')->create();
            // factory('App\S_Main_Address')->create([
            //     'spi_id' => $student->spi_id,
            //     'add_id' => $address->add_id,
            // ]);

            // factory('App\StudentImage')->create([
            //     'spi_id' => $student->spi_id,
            // ]);
            

            // $school_info->each(function ($school_info) {
            //     factory('App\Year', 3)->create(['ssi_id' => $school_info->ssi_id]);
            //     factory('App\SubjectEnrolled', 5)->create(['ssi_id' => $school_info->ssi_id]);
            //     // factory('App\SubjectEnrolledStatus', 5)->create(['ssi_id' => $school_info->ssi_id]);
            // });
        });







        
    }
}
