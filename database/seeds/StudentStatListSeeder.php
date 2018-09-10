<?php

use Illuminate\Database\Seeder;

class StudentStatListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
        	'graduate' , 'undergraduate'
        ];

        foreach ($datas as $data) {
        	App\Stud_Stat_List::create([
        		'stat_name' => $data
        	]);
        }
    }
}
