<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
    		'ARMM', 
    		'CAR', 
    		'CARAGA', 
    		'NCR', 
    		'Region I', 
    		'Region II', 
    		'Region III', 
    		'Region IV-A', 
    		'Region IV-B', 
    		'Region IX', 
    		'Region V', 
    		'Region VI', 
    		'Region VII', 
    		'Region VIII', 
    		'Region X', 
    		'Region XI', 
    		'Region XII', 
    	];

    	foreach ($regions as $country) {
        	App\Region::create(['region_name' => $country, 'country_id' => 1]);
        }
    }
}
