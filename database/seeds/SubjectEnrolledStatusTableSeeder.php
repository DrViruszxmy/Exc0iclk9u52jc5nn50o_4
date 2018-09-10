<?php

use Illuminate\Database\Seeder;

class SubjectEnrolledStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['enrolled', 'drop', 'add', 'change', 'withdraw'];

        foreach ($status as $stat) {
        	App\SubjectEnrolledStatus::create(['status' => $stat]);
        }
    }
}
