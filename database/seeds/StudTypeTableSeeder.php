<?php

use Illuminate\Database\Seeder;

class StudTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stud_types = ['College', 'Senior High'];

        foreach ($stud_types as $type) {
        	App\StudentType::create([
        		'type' => $type, 
        		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum, recusandae.' 
        	]);
        }
    }
}
