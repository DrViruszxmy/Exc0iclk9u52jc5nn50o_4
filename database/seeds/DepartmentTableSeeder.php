<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Information Technology Education Program', 
        	'Computer Science Education Program', 
        	'Business Education Program',
        	'Senior High Education Program'
        ];

        foreach ($departments as $department) {
        	App\Department::create([
        		'dep_name' => $department, 
        		'dep_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, recusandae.' 
        	]);
        }
    }
}
