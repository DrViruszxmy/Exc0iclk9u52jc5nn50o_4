<div class="educational-wrapper">
    
    @include('student_information.partials.schools.school_info', [
        'school_level' => 'Elementary',
        'school_level_key' => 'elementary'
    ])
	<br>
    <hr>
    
    @include('student_information.partials.schools.school_info', [
        'school_level' => 'Junior High School',
        'school_level_key' => 'junior_high'
    ])

    <br>
    <hr>
    
    @include('student_information.partials.schools.school_info', [
        'school_level' => 'Senior High School',
        'school_level_key' => 'senior_high'
    ])
    
    <br>
    <hr>
    
    @include('student_information.partials.schools.vocational_record', [
        'school_level' => 'Vocational / Trade Course',
        'school_level_key' => 'vocational_record'
    ])

    <br>
    <hr>
    
    @include('student_information.partials.schools.vocational_record', [
        'school_level' => 'College',
        'school_level_key' => 'college'
    ])
</div>