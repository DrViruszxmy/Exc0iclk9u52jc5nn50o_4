<div class="nav-content-wrap">
    <h4>{{ $school_level }}</h4>
    <div class="bginfo">
        <div v-for="(school, schoolIndex) in form['{{$school_level_key}}']">
            <div class="row">
                <div class="col-md-12 label-color">
                    <div :class="checkErrorHeader('{{$school_level_key}}.'+schoolIndex+'.sch_name')">
                        <div class="row">
                            <label :for="'{{$school_level_key}}.'+schoolIndex+'.sch_name'" class="control-label col-md-4">
                                Name of School: 
                            </label>
                            <div class="col-md-7 margin-bottom10 padding-zero">
                            
                               <!--  <input type="text"
                                    :id="'{{$school_level_key}}.'+schoolIndex+'.sch_name'" 
                                    :name="'{{$school_level_key}}.'+schoolIndex+'.sch_name'" 
                                    v-model="school.sch_name" 
                                    class="form-control select-text-g" 
                                    @keyup="generateSchool($event, '{{ $school_level_key }}', schoolIndex)"
                                > -->
                                <select :name="'{{$school_level_key}}.'+schoolIndex+'.sch_name'"  :id="'{{$school_level_key}}.'+schoolIndex+'.sch_name'" v-model="school.sch_name" 
                                class="form-control select-text-g" >
                                    <option value="" selected disabled></option>
                                    @if($school_level_key == 'junior_high')
                                        @foreach($junior_high_lists as $junior_high_list)
                                            <option value="{{ $junior_high_list->school_name }}">
                                                {{ $junior_high_list->school_name }}-------{{ $junior_high_list->sl_id }}
                                            </option>
                                        @endforeach
                                    @endif
                                    @if($school_level_key == 'senior_high')
                                        @foreach($senior_high_lists as $senior_high_list)
                                            <option value="{{ $senior_high_list->school_name }}">
                                                {{ $senior_high_list->school_name }}-------{{ $senior_high_list->sl_id }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <!-- <ul v-if="school.isActiveSchoolName" class="text-left list-group search-custom-s label-color" v-cloak v-click-outside-school="hide">
                                    <li  v-for="(field, index) v-cloak in filteredSchools" 
                                        class="list-group-item" @click="selectedSchool(field.school_name, schoolIndex, '{{ $school_level_key }}')">
                                        @{{field.school_name}}
                                    </li>
                                </ul> -->
                                <span class="help-block" v-if="form.errors.has('{{$school_level_key}}.'+schoolIndex+'.sch_name')" v-text="form.errors.get('{{$school_level_key}}.'+schoolIndex+'.sch_name')"></span>
                            </div>
                        </div>
                    </div>


                    





                    <div :class="checkErrorHeader('{{$school_level_key}}.'+schoolIndex+'.sch_year')">
                        <div class="row">
                            <label :for="'{{$school_level_key}}.'+schoolIndex+'.sch_year'" class="control-label col-md-4">
                                School Year: 
                            </label>
                            <div class="col-md-7 margin-bottom10 padding-left-zero">
                                <input type="text"
                                    id="'{{$school_level_key}}.'+schoolIndex+'.sch_year'" 
                                    :name="'{{$school_level_key}}.'+schoolIndex+'.sch_year'" 
                                    v-model="school.sch_year" 
                                    class="form-control select-text-g" 
                                >
                                <span class="help-block" v-if="form.errors.has('{{$school_level_key}}.'+schoolIndex+'.sch_year')" v-text="form.errors.get('{{$school_level_key}}.'+schoolIndex+'.sch_year')"></span>
                            </div>
                        </div>
                    </div>

                    <div :class="checkErrorHeader('{{$school_level_key}}.'+schoolIndex+'.sector')">
                        <div class="row">
                            <label :for="'{{$school_level_key}}.'+schoolIndex+'.sector'" class="control-label col-md-4">
                                Sector
                            </label>
                            <div class="col-md-7 margin-bottom10 padding-left-zero">
                                <select 
                                    id="'{{$school_level_key}}.'+schoolIndex+'.sector'" 
                                    :name="'{{$school_level_key}}.'+schoolIndex+'.sector'" 
                                    class="form-control select-text-g xlarge-select"
                                    v-model="school.sector" 
                                >
                                    <option value="" selected disabled>Select Sector</option>
                                    <option value="private">Private</option>
                                    <option value="public">Public</option>
                                    
                                </select>
                                <span class="help-block" v-if="form.errors.has('{{$school_level_key}}.'+schoolIndex+'.sector')" v-text="form.errors.get('{{$school_level_key}}.'+schoolIndex+'.sector')"></span>
                            </div>
                        </div>
                    </div>

                    
                    <div :class="checkErrorHeader('student.highest_level')">
                        <div class="row">
                            <label for="student.highest_level" class="control-label col-md-4">
                                HIGHEST GRADE / LEVEL ATTAINED: 
                            </label>
                            <div class="col-md-7 margin-bottom10 padding-left-zero">
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
                                Scholarship/Academic Honors: 
                            </label>
                            <div class="col-md-7 margin-bottom10 padding-left-zero">
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
          <!--       <div class="col-md-5 label-color">
                    @include('admission.partials.address', ['address_type' => 'presentAddress', 'category' => "$school_level_key" ])
                </div> -->
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