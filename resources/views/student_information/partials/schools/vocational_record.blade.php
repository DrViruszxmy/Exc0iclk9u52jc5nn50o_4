<div class="nav-content-wrap">
    <h4>{{ $school_level }}</h4>
    <div class="bginfo">
        <div v-for="(school, schoolIndex) in form['{{$school_level_key}}']">
            <div class="row">
                <div class="col-md-7 label-color">
                    <div :class="checkErrorHeader('student.sch_name')">
                        <div class="row">
                            <label for="student.sch_name" class="control-label col-md-4">
                                Name of School: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <!-- <input type="text"
                                    name="student.{{$school_level_key}}.sch_name" 
                                    v-model="school.sch_name" 
                                    class="form-control select-text-g" 
                                     @keyup="generateSchool($event, '{{ $school_level_key }}', schoolIndex)"
                                >
                                <ul v-if="school.isActiveSchoolName" class="text-left list-group search-custom-s label-color" v-cloak v-click-outside-school="hide">
                                    <li  v-for="(field, index) v-cloak in filteredSchools" 
                                        class="list-group-item" @click="selectedSchool(field.school_name, schoolIndex, '{{ $school_level_key }}')">
                                        @{{field.school_name}}
                                    </li>
                                </ul> -->
                                <select name="student.{{$school_level_key}}.sch_name" 
                                    v-model="school.sch_name" 
                                    class="form-control select-text-g">
                                    <option value="" selected disabled></option>
                                    @if($school_level_key == 'college')
                                        @foreach($college_lists as $college_list)
                                            <option value="{{ $college_list->school_name }}">
                                                {{ $college_list->school_name }}-------{{ $college_list->sl_id }}
                                            </option>
                                        @endforeach
                                    @endif
                                    @if($school_level_key == 'vocational_record')
                                        @foreach($vocational_record_lists as $vocational_record_list)
                                            <option value="{{ $vocational_record_list->school_name }}">
                                                {{ $vocational_record_list->school_name }}-------{{ $vocational_record_list->sl_id }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-block" v-if="form.errors.has('student.sch_name')" v-text="form.errors.get('student.sch_name')"></span>
                            </div>
                        </div>
                    </div>

                    <div :class="checkErrorHeader('student.course')">
                        <div class="row">
                            <label for="student.course" class="control-label col-md-4">
                                Course: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <input type="text"
                                    name="student.{{$school_level_key}}.course" 
                                    v-model="school.course" 
                                    class="form-control select-text-g"
                                >
                                <span class="help-block" v-if="form.errors.has('student.course')" v-text="form.errors.get('student.course')"></span>
                            </div>
                        </div>
                    </div>

                    <div :class="checkErrorHeader('student.sch_year')">
                        <div class="row">
                            <label for="student.sch_year" class="control-label col-md-4">
                                School Year: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <input type="text"
                                    name="student.{{$school_level_key}}.sch_year" 
                                    v-model="school.sch_year" 
                                    class="form-control select-text-g"
                                >
                                <span class="help-block" v-if="form.errors.has('student.sch_year')" v-text="form.errors.get('student.sch_year')"></span>
                            </div>
                        </div>
                    </div>

                    <div :class="checkErrorHeader('student.year_graduated')">
                        <div class="row">
                            <label for="student.year_graduated" class="control-label col-md-4">
                                Year Graduated: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <input type="text"
                                    name="student.{{$school_level_key}}.year_graduated" 
                                    v-model="school.year_graduated" 
                                    class="form-control select-text-g"
                                >
                                <span class="help-block" v-if="form.errors.has('student.year_graduated')" v-text="form.errors.get('student.year_graduated')"></span>
                            </div>
                        </div>
                    </div>

                    <div :class="checkErrorHeader('student.highest_level')">
                        <div class="row">
                            <label for="student.highest_level" class="control-label col-md-4">
                                HIGHEST GRADE / LEVEL ATTAINED: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <input type="text"
                                    name="student.{{$school_level_key}}.highest_level" 
                                    v-model="school.highest_level" 
                                    class="form-control select-text-g"
                                >
                                <span class="help-block" v-if="form.errors.has('student.highest_level')" v-text="form.errors.get('student.highest_level')"></span>
                            </div>
                        </div>
                    </div>

                    <div :class="checkErrorHeader('student.academic_honor')">
                        <div class="row">
                            <label for="student.academic_honor" class="control-label col-md-4">
                                Scholarship/<br>Academic Honors: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <input type="text"
                                    name="student.{{$school_level_key}}.academic_honor" 
                                    v-model="school.academic_honor" 
                                    class="form-control select-text-g"
                                >
                                <span class="help-block" v-if="form.errors.has('student.academic_honor')" v-text="form.errors.get('student.academic_honor')"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-5 padding-right-zero label-color">
                    @include('student_information.partials.schools.address', [
                        'address_type' => 'presentAddress', 
                        'category' => "$school_level_key" 
                    ])
                </div>
            </div>
            <hr class="custom-hr-space"> 
        </div>
    </div>
    <div class="add-wrap">
        <div class="row">
            <div class="col-md-12 text-center padding-wrap-bottom">
                <button type="button" class="btn btn-default" @click="addSchool('{{$school_level_key}}')">Add {{ $school_level }}</button>
                <button type="button" v-if="form.{{$school_level_key}}.length > 1" class="btn btn-danger" @click="removeAddress('{{$school_level_key}}')">Remove {{ $school_level }}</button>
            </div>
        </div>
    </div>
</div>