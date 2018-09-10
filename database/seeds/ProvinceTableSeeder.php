<?php

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $provincies = [
            'BASILAN' => 1,
            'LANAO DEL SUR' => 1,
            'MAGUINDANAO' => 1,
            'SULU' => 1,
            'TAWI-TAWI' => 1,
            'SHARIFF KABUNSUAN' => 1,
            'ABRA' => 2,
            'BENGUET' => 2,
            'IFUGAO' => 2,
            'KALINGA' => 2,
            'MOUNTAIN PROVINCE' => 2,
            'APAYAO' => 2,
            'AGUSAN DEL NORTE' => 3,
            'AGUSAN DEL SUR' => 3,
            'SURIGAO DEL NORTE' => 3,
            'SURIGAO DEL SUR' => 3,
            'DINAGAT ISLANDS' => 3,
            'MANILA, NCR,  FIRST DISTRICT' => 4,
            'NCR SECOND DISTRICT' => 4,
            'NCR THIRD DISTRICT' => 4,
            'NCR FOURTH DISTRICT' => 4,
            'ILOCOS NORTE' => 5,
            'ILOCOS SUR' => 5,
            'LA UNION' => 5,
            'PANGASINAN' => 5,
            'BATANES' => 6,
            'CAGAYAN' => 6,
            'ISABELA' => 6,
            'NUEVA VIZCAYA' => 6,
            'QUIRINO' => 6,
            'BATAAN' => 7,
            'BULACAN' => 7,
            'NUEVA ECIJA' => 7,
            'PAMPANGA' => 7,
            'TARLAC' => 7,
            'ZAMBALES' => 7,
            'AURORA' => 7,
            'BATANGAS' => 8,
            'CAVITE' => 8,
            'LAGUNA' => 8,
            'QUEZON' => 8,
            'RIZAL' => 8,
            'MARINDUQUE' => 9,
            'OCCIDENTAL MINDORO' => 9,
            'ORIENTAL MINDORO' => 9,
            'PALAWAN' => 9,
            'ROMBLON' => 9,
            'ZAMBOANGA DEL NORTE' => 10,
            'ZAMBOANGA DEL SUR' => 10,
            'ZAMBOANGA SIBUGAY' => 10,
            'CITY OF ISABELA' => 10,
            'ALBAY' => 11,
            'CAMARINES NORTE' => 11,
            'CAMARINES SUR' => 11,
            'CATANDUANES' => 11,
            'MASBATE' => 11,
            'SORSOGON' => 11,
            'AKLAN' => 12,
            'ANTIQUE' => 12,
            'CAPIZ' => 12,
            'ILOILO' => 12,
            'NEGROS OCCIDENTAL' => 12,
            'GUIMARAS' => 12,
            'BOHOL' => 13,
            'CEBU' => 13,
            'NEGROS ORIENTAL' => 13,
            'SIQUIJOR' => 13,
            'EASTERN SAMAR' => 14,
            'LEYTE' => 14,
            'NORTHERN SAMAR' => 14,
            'WESTERN SAMAR' => 14,
            'SOUTHERN LEYTE' => 14,
            'BILIRAN' => 14,
            'BUKIDNON' => 15,
            'CAMIGUIN' => 15,
            'LANAO DEL NORTE' => 15,
            'MISAMIS OCCIDENTAL' => 15,
            'MISAMIS ORIENTAL' => 15,
            'DAVAO DEL NORTE' => 16,
            'DAVAO DEL SUR' => 16,
            'DAVAO ORIENTAL' => 16,
            'COMPOSTELA VALLEY' => 16,
            'NORTH COTABATO' => 17,
            'SOUTH COTABATO' => 17,
            'SULTAN KUDARAT' => 17,
            'SARANGANI' => 17,
            'CITY OF COTABATO' => 17,
        ];

        foreach ($provincies as $province => $region ) {
        	App\Province::create([
        		'province_name' => $province,
        		'reg_id' => $region
        	]);
        }
    }
}
