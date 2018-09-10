<?php

use Illuminate\Database\Seeder;

class RequirementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Requirement', 100)->create();
    }
}
