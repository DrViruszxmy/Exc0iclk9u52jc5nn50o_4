<?php

use Illuminate\Database\Seeder;

class RequirementListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requirements = ['High School Card', 'Honorable Dismissal', 'Form 137-A', 'BC / NSO', 'GMC', 'TOR'];

        foreach ($requirements as $requirement) {
        	App\Requirement_List::create([
        		'requirements' => $requirement,
        		'quantity' => 3,
        	]);
        }
    }
}
