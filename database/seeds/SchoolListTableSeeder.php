<?php

use Illuminate\Database\Seeder;

class SchoolListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $schools = [
            'Bayugan National Comprehensive High School' => 'junior_high', 
            'Agusan Del Sur High School' => 'junior_high'
        ];

        foreach ($schools as $key => $value) {
            App\SchoolList::create([
                'school_name' => $key,
                'category' => $value,
            ]);
        }
    }
}
