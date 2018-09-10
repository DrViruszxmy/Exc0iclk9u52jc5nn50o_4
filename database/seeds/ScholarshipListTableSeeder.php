<?php

use Illuminate\Database\Seeder;

class ScholarshipListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scholarship_list = ['Ched Scholar', 'S.A'];

        foreach ($scholarship_list as $scholarship) {
        	App\Scholarship_List::create([
        		'scholarship_type' => $scholarship
        	]);
        }
    }
}
