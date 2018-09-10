<?php

use Illuminate\Database\Seeder;

class ProgramListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = "";
        $department = 1;

        //COllege
        $college_program_code = [
            'ITWESW', 'BSYES','BSSHE','BGAKEW','ARWEWW'
        ];

        $college_program_name = [
            'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY',
            'BACHELOR OF SCIENCE IN COMPUTER SCIENCE',
            'Bachelor of Science in Business Administration',
            'Computer-based Accounting',
            'Architectural Design Technology'
        ];

        $college_program_abv = [
        	'BSIT', 'BSCS','BSBA','CBA','ADT'
        ];


        //Senior High
        $seniorhigh_program_code = [
            'WERWE', 'GERER','QWEQWR','RTRTY','DFGYR', 'FWWEQWQ', 'GFEWEW'
        ];

        $seniorhigh_program_name = [
            'Accountancy, Business and Management', 
            'General Academic Strand', 
            'Humanities and Social Sciences',
            'Science, Technology, Engineering and Mathematics',
            'Home Economics',
            'Industrial Arts',
            'Information and Communications Technology'
        ];

        $seniorhigh_program_abv = [
            'ABM', 'GAS','HUMMS','STEM','HE', 'IE', 'ICT'
        ];


        $program_type = [
            '4 year course', '2 year course'
        ];

        $level = [
            'College', 'Senior High'
        ];


        foreach ($college_program_abv as $key => $college_program) {

            if($college_program == 'BSIT' || $college_program == 'BSCS' || $college_program == 'BSBA'){
                $type = $program_type[0];
            } else {
                $program_type[1];
            }

            if($college_program == 'BSIT' || $college_program == 'BSCS'){
                $department = 1;
            } else{
                $department = 2;
            }

        	$program = App\ProgramList::create([
        		'prog_code' => $college_program_code[$key], 
                'prog_abv' =>  $college_program,
                'prog_name' =>  $college_program_name[$key],
                'prog_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, recusandae.', 
                'prog_type' =>  $type,
                'level' =>  $level[0],
                'major' =>  'Web Development',
        		'dep_id' =>  $department
        	]);

            App\Usage_Status::create([
                'status' => 'active',
                'pl_id' => $program->pl_id
            ]);
        }



        foreach ($seniorhigh_program_abv as $key => $seniorhigh_program) {

            $program = App\ProgramList::create([
                'prog_code' => $seniorhigh_program_code[$key], 
                'prog_abv' =>  $seniorhigh_program,
                'prog_name' =>  $seniorhigh_program_name[$key],
                'prog_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, recusandae.', 
                'prog_type' =>  $program_type[1],
                'level' =>  $level[1],
                'major' =>  '',
                'dep_id' =>  1
            ]);

            App\Usage_Status::create([
                'status' => 'active',
                'pl_id' => $program->pl_id
            ]);
        }
    }
}
