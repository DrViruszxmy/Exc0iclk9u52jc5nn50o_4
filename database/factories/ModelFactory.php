<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/*
|-----------------------------------------------------------------------------------------------------------
| StudentPersonalInfo Model Factory
|-----------------------------------------------------------------------------------------------------------
*/

$factory->define(App\StudentPersonalInfo::class, function (Faker\Generator $faker) {
    $gender = ['male', 'female'];
    $status = ['single', 'married'];
    $blood_type = ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'];
    $selected_gender = $faker->numberBetween($min = 0, $max = 1);
    $person_gender = "";
    $person_fname = "";

    if($selected_gender == 0){
        $person_gender = $gender[$selected_gender];
        $person_fname = $faker->firstNameMale;
    } else {
        $person_gender = $gender[$selected_gender];
        $person_fname = $faker->firstNameFemale;
    }

    return [
        'fname' => $person_fname,
        'mname' => $faker->lastName,
        'lname' => $faker->lastName,
        'suffix' => $faker->suffix,
        'gender' => $person_gender,
        'civ_status' => $status[$faker->numberBetween($min = 0, $max = 1)],
        'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'birthplace' => $faker->city,
        'weight' => $faker->numberBetween($min = 50, $max = 80),
        'height' => $faker->numberBetween($min = 150, $max = 180),
        'blood_type' => $blood_type[$faker->numberBetween($min = 0, $max = 7)],
        'cit_id' => $faker->numberBetween($min = 1, $max = 4),
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| StudentSchoolInfo Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\StudentSchoolInfo::class, function (Faker\Generator $faker) {

    return [
        'stud_id' => $faker->randomNumber(8),
        'acct_no' => $faker->randomNumber(8),
        'usn_no' => $faker->randomNumber(8),
        'spi_id' => function () {
            return factory(App\StudentPersonalInfo::class)->create()->spi_id;
        },
        // 'st_id' => $faker->numberBetween($min = 1, $max = 2),
        'st_id' => 1,
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Year Model Factory
|-----------------------------------------------------------------------------------------------------------
*/

$factory->define(App\Year::class, function (Faker\Generator $faker) {
    $year = ['2015-2016'];
    $sem = ['1st', '2nd'];
    $year_status = ['1st', '2nd', '3rd', '4th'];
    $student_regular = ['regular', 'irregular'];
    $current_stat = ['old', 'new', 'transferee'];

    return [
        // 'sch_year' => $year[$faker->numberBetween($min = 0, $max = 8)],
        // 'semester' => $sem[$faker->numberBetween($min = 0, $max = 1)],
        // 'year' => $year_status[$faker->numberBetween($min = 0, $max = 3)],
        // 'year_stat' => $student_regular[$faker->numberBetween($min = 0, $max = 1)],
        // 'remarks' => $faker->text,
        // 'current_stat' => $current_stat[$faker->numberBetween($min = 0, $max = 2)],

        'sch_year' => $year[0],
        'semester' => $sem[1],
        'year' => $year_status[0],
        'year_stat' => $student_regular[0],
        'remarks' => $faker->text,
        'current_stat' => $current_stat[1],
        'ssi_id' => function () {
            return factory(App\StudentSchoolInfo::class)->create()->ssi_id;
        },
    ];
    
});

// ---------------------------------------------------------------------------------------------------------





/*
|-----------------------------------------------------------------------------------------------------------
| Hschool_Student Model Factory
|-----------------------------------------------------------------------------------------------------------
*/

$factory->define(App\Hschool_Student::class, function (Faker\Generator $faker) {
    $year = ['2005-2006', '2006-2007', '2007-2008'];

    return [
        'sch_year' => $year[$faker->numberBetween($min = 0, $max = 2)],
        'sector' => 'public',
        'highest_level' => '',
        'academic_honor' => '',
        'type' => 'junior high',
        'last_school' => 'yes',
        'spi_id' => function () {
            return factory(App\StudentPersonalInfo::class)->create()->spi_id;
        },
        'sl_id' => $faker->numberBetween($min = 1, $max = 2),
    ];
    
});

// ---------------------------------------------------------------------------------------------------------





/*
|-----------------------------------------------------------------------------------------------------------
| Parents Model Factory
|-----------------------------------------------------------------------------------------------------------
*/

$factory->define(App\Parents::class, function (Faker\Generator $faker) {
    $selected_gender = $faker->numberBetween($min = 0, $max = 1);
    $type = [1,1,1,3,4];
    $person_fname = "";

    if($selected_gender == 0){
        $person_fname = $faker->firstNameMale;
    } else {
        $person_fname = $faker->firstNameFemale;
    }

    return [
        'fname' => $person_fname,
        'mname' => $faker->lastName,
        'lname' => $faker->lastName,
        'suffix' => $faker->suffix,
        'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'occupation' => $faker->numberBetween($min = 1, $max = 4),
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Parents_Student Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\Parents_Student::class, function (Faker\Generator $faker) {

    return [
        'parent_id' => $faker->numberBetween($min = 1, $max = 50),
        'spi_id' => $faker->numberBetween($min = 1, $max = 100),
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| StudentProgram Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\StudentProgram::class, function (Faker\Generator $faker) {

    $select_sem = $faker->numberBetween($min = 0, $max = 1);
    $first_num = 0;
    $sec_num = 0;

    if($select_sem == 1){
        $select_sem = 1;
        $first_num = 6;
        $sec_num = 12;
    } else {
        $first_num = 1;
        $sec_num = 5;
        $select_sem = 0;
    }

    return [
        'sch_year' => function () {
            return factory(App\Year::class)->create()->sch_year;
        },
        'semester' => function () {
            return factory(App\Year::class)->create()->semester;
        },
        // 'pl_id' => $faker->numberBetween($min = 1, $max = 12),
        'pl_id' => 1,
        'ssi_id' => function () {
            return factory(App\StudentSchoolInfo::class)->create()->ssi_id;
        },
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| SubjectEnrolled Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\SubjectEnrolled::class, function (Faker\Generator $faker) {

    return [
        'ssi_id' => function () {
            return factory(App\StudentSchoolInfo::class)->create()->ssi_id;
        },
        'ses_id' => $faker->numberBetween($min = 1, $max = 2),
        'ss_id' => $faker->numberBetween($min = 113, $max = 130)
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Requirement Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\Requirement::class, function (Faker\Generator $faker) {

    return [
        'rl_id' => $faker->numberBetween($min = 1, $max = 6),
        'spi_id' => function () {
            return factory(App\StudentPersonalInfo::class)->create()->spi_id;
        },
        'date' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'quantity' => $faker->numberBetween($min = 1, $max = 3),
    ];
    
});

// ---------------------------------------------------------------------------------------------------------


/*
|-----------------------------------------------------------------------------------------------------------
| Scholarship Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\Scholarship::class, function (Faker\Generator $faker) {
    $year = ['2008-2009', '2009-2010', '2010-2011', '2011-2012', '2012-2013', '2013-2014', '2014-2015', '2015-2016', '2016-2017'];
    $sem = ['1st', '2nd'];
    return [
        'ssi_id' => $faker->numberBetween($min = 1, $max = 30),
        'sl_id' => $faker->numberBetween($min = 1, $max = 2),
        'sch_year' => $year[$faker->numberBetween($min = 0, $max = 8)],
        'semester' => $sem[$faker->numberBetween($min = 0, $max = 1)]
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Address Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\Address::class, function (Faker\Generator $faker) {

    return [
        'street' => $faker->city,
        'country_id' => 1,
        'province_id' => 13,
        'reg_id' => 3,
        'city_id' => 206,
        'brgy_id' => $faker->numberBetween($min = 1, $max = 86),
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Address Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\S_Main_Address::class, function (Faker\Generator $faker) {
    $address_type = ['presentAddress', 'permanentAddress'];
    return [
        'spi_id' => function () {
            return factory(App\StudentPersonalInfo::class)->create()->spi_id;
        },
        'add_id' => function () {
            return factory(App\Address::class)->create()->add_id;
        },
        'address_type' => $address_type[$faker->numberBetween($min = 0, $max = 1)],
        'use_present_address' => 'yes'
    ];
    
});

// ---------------------------------------------------------------------------------------------------------



/*
|-----------------------------------------------------------------------------------------------------------
| SubjectEnrolledStatus Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\StudentEnrollmentStat::class, function (Faker\Generator $faker){
    $status = ['enrolled', 'not enrolled'];
    return [
        'ssi_id' => function () {
            return factory(App\StudentSchoolInfo::class)->create()->ssi_id;
        },
        'status' => $status[0],
        'sch_year' => function () {
            return factory(App\Year::class)->create()->sch_year;
        },
        'semester' => function () {
            return factory(App\Year::class)->create()->semester;
        },
        'dated' => $faker->dateTimeThisCentury->format('Y-m-d'),
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Curriculum used Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\Curr_Used::class, function (Faker\Generator $faker){
    return [
        'ssi_id' => function () {
            return factory(App\StudentSchoolInfo::class)->create()->ssi_id;
        },
        'c_code' => 'CBA-1718-SEM1',
        'sch_year' => '2017-2018',
        'semester' => '2nd',
        'status' => 'active',
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Enrollment flow used Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\EfStudentUse::class, function (Faker\Generator $faker){
    return [
        'ssi_id' => function () {
            return factory(App\StudentSchoolInfo::class)->create()->ssi_id;
        },
        'efv_id' => 1,
        'sch_year' => '2012-2013',
        'semester' => '1st',
        'date_used' => '2012-11-18',
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Enrollment classification used Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\EfsClassification::class, function (Faker\Generator $faker){
    return [
        'ef_id' => 1,
        'efv_id' => 1,
        'date' => '2017-11-18',
    ];
    
});

// ---------------------------------------------------------------------------------------------------------




/*
|-----------------------------------------------------------------------------------------------------------
| Enrollment Steps used Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\EfsStudentMode::class, function (Faker\Generator $faker){
    return [
        'ssi_id' => function () {
            return factory(App\StudentSchoolInfo::class)->create()->ssi_id;
        },
        'efc_id' => 1,
        'mode' => 'undone',
        'date' => '2017-11-18',
    ];
    
});

// ---------------------------------------------------------------------------------------------------------


/*
|-----------------------------------------------------------------------------------------------------------
| Student Image Model Factory
|-----------------------------------------------------------------------------------------------------------
*/
$factory->define(App\StudentImage::class, function (Faker\Generator $faker){
    $status = ['enrolled', 'not enrolled'];
    return [
        'spi_id' => function () {
            return factory(App\StudentPersonalInfo::class)->create()->spi_id;
        },
        'image_path' => 'images/student-info/photo/'. $faker->image('public/images/student-info/photo', 400,300, null, false),
        'image_name' => 'default',
        'type' => 'primary',
    ];
    
});

// ---------------------------------------------------------------------------------------------------------

