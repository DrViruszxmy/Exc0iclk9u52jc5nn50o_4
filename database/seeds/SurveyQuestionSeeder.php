<?php

use Illuminate\Database\Seeder;

class SurveyQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
        	'Are you related by consanguinity or affinity for any of the following', 
        	"Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972) please answer the following items",
        ];

        $sub_questions = [
        	'1' => 'Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal',
        	'2' => 'Are you a member of any indigenous group',
        	'2' => 'Are you differently abled',
        	'2' => 'Are you a solo parent'
       	];

        // 1 Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal
        // 2 Are you a member of any indigenous group
        // 2 Are you differently abled
        // 2  Are you a solo parent

        foreach ($questions as $question) {
        	$main_question = App\QuestionCategory::create([
			        		'title' => $question, 
			        	]);
        }

        foreach ($sub_questions as $key => $sub_question) {
            App\Questions::create([
                'qc_id' => $key, 
                'title' => $sub_question, 
            ]);
        }
    }
}
