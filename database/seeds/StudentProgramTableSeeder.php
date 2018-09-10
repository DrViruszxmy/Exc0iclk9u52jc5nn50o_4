<?php

use Illuminate\Database\Seeder;

class StudentProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\StudentProgram', 100)->create();
    }
}
