<?php

use Illuminate\Database\Seeder;

class EnrollmentModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
        	'Dashboard', 
        	'Admission', 
        	'Examination', 
        	'Cashier', 
        	'Student Information', 
        	'Subject Crediting', 
        	'Student Subject Loading', 
            'Accounting', 
            'SSG', 
        	'Student Subject Advising', 
            'Grade Evaluation'
        ];

        foreach ($modules as $module) {
        	App\EnrollmentModule::create([
        		'module_name' => $module,
        	]);
        }
    }
}
