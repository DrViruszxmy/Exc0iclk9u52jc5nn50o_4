<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
    		'English', 'Tagalog', 'Bisaya'
    	];

    	foreach ($languages as $language) {
        	App\Language::create(['language' => $language]);
        }
    }
}
