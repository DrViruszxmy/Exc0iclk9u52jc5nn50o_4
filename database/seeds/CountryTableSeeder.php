<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
    		'Philippines'
    	];

    	foreach ($countries as $country) {
        	App\Country::create(['country_name' => $country]);
        }
    }
}
