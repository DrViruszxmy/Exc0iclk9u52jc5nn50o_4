<?php

use Illuminate\Database\Seeder;

class ParentsStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Parents_Student', 0)->create();
    }
}
