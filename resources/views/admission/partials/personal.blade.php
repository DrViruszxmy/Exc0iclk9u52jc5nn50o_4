<div class="">
	<div class="nav-content-wrap">
		<div class="bginfo">
            <div class="row label-color">
                <div class="col-md-2 padding-left-zero">
                    <div class="radio checkbox1" @click="selectLevel('senior_high')">
                        <label>
                            <input type='radio' value='senior_high' v-model="form.student.enrolleeType" name='enrolleeType' 
                            checked="true">
                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            <small>Senior High</small>
                        </label>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="radio checkbox1" @click="selectLevel('college')">
                        <label>
                            <input type='radio' value='college' v-model="form.student.enrolleeType" name='enrolleeType'>
                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            <small>College</small>
                        </label>
                    </div>
                </div>
                <div class="col-md-3 padding-left-zero">
                    <div class="radio checkbox1" @click="selectLevel">
                        <label>
                            <input type='radio' value='short_course' v-model="form.student.enrolleeType" name='enrolleeType'>
                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            <small>Short Course</small>
                        </label>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-md-7 label-color">
					<div :class="checkErrorHeader('student.lname')">
                        <div class="row">
                            <label for="student.lname" class="control-label col-md-3 padding-right-zero">
                                Last name: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <input type="text"
                                    :recordDataName="recordDataName('lname')" 
                                    name="student.lname" 
                                    v-model="form.student.lname" 
                                    class="form-control select-text-g"
                                    :id="form.student.lname" 
                                >
                                <span class="help-block" v-if="form.errors.has('student.lname')" v-text="form.errors.get('student.lname')"></span>
                            </div>
                        </div>
                    </div>
					
					<div :class="checkErrorHeader('student.fname')">
                        <div class="row">
                            <label for="student.fname" class="control-label col-md-3 padding-right-zero">
                                First name: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <input type="text" 
                                    :recordDataName="recordDataName('fname')"
                                    name="student.fname" 
                                    v-model="form.student.fname" 
                                    class="form-control select-text-g"
                                    :id="form.student.fname" 
                                >
                                <span class="help-block" v-if="form.errors.has('student.fname')" v-text="form.errors.get('student.fname')"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div :class="checkErrorHeader('student.mname')">
                        <div class="row">
                            <label for="student.mname" class="control-label col-md-3 padding-right-zero">
                                Middle name: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <input type="text" 
                                    :recordDataName="recordDataName('mname')" 
                                    name="student.mname" 
                                    v-model="form.student.mname" 
                                    class="form-control select-text-g"
                                    :id="form.student.mname" 
                                >
                                <span class="help-block" v-if="form.errors.has('student.mname')" v-text="form.errors.get('student.mname')"></span>
                            </div>
                        </div>
                    </div>

					<div :class="checkErrorHeader('student.suffix')">
                        <div class="row">
                            <label for="student.suffix" class="control-label col-md-3 padding-right-zero">
                                Suffix
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <select name="student.suffix" 
                                    :recordDataName="recordDataName('suffix')"
                                    id="" 
                                    class="form-control select-text-g xlarge-select"
                                    v-model="form.student.suffix" 
                                >
                                    <option value="">Select Suffix</option>
                                    @if(count($suffix))
                                        @foreach($suffix as $value)
                                            <option value="{{$value->id}}">{{$value->value}}</option>
                                        @endforeach
                                    @endif
                                    
                                </select>
                                <span class="help-block" v-if="form.errors.has('student.suffix')" v-text="form.errors.get('student.suffix')"></span>
                            </div>
                        </div>
                    </div>
                    <div :class="checkErrorHeader('student.cit_id')">
                        <div class="row">
                            <label for="student.cit_id" class="control-label col-md-3 padding-right-zero">
                                Citizenship
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <select name="student.cit_id" 
                                    :recordDataName="recordDataName('cit_id')" 
                                    id="" 
                                    class="form-control select-text-g xlarge-select"
                                    v-model="form.student.cit_id" 
                                >
                                    <option value="">Select Citizenship</option>
                                    @if(count($citizenship))
                                        @foreach($citizenship as $value)
                                            <option value="{{$value->id}}">{{$value->value}}</option>
                                        @endforeach
                                    @endif
                                    
                                </select>
                                <span class="help-block" v-if="form.errors.has('student.cit_id')" v-text="form.errors.get('student.cit_id')"></span>
                            </div>
                        </div>
                    </div>
					<div :class="checkErrorHeader('student.major')">
                        <div class="row">
                            <label for="student.major" class="control-label col-md-3 padding-right-zero">
                                Contact No: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <div  class="form-group" :class="{'has-error': form.errors.has('student.contact.'+ index + '.phone_number')}" 
                                v-for="(contact, index) in form.student.contact">
                                    <template v-if="form.student.enrolleeType != 'short_course'">
                                        <div class="input-group contact-z-index">
                                            <input type="text" minlength="1" maxlength="11" :name="'student.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                                                v-model="contact.phone_number">
                                            <div class="input-group-addon add-field" v-if="index > 0" @click="removeContactNumber">
                                                <a>
                                                    <span class="glyphicon glyphicon-minus"></span>
                                                </a>
                                            </div>
                                            <div class="input-group-addon add-field" @click="addContactNumber">
                                                <a>
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <input type="number" :name="'student.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                                                v-model="contact.phone_number">
                                    </template>
                                    <span class="help-block" v-if="form.errors.has('student.contact.'+ index + '.phone_number')" v-text="form.errors.get('student.contact.'+ index + '.phone_number')"></span>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="custom-form-group">
                        <div class="row">
                            <label for="student.lname" class="control-label col-md-3 padding-right-zero">
                                Siblings: 
                            </label>
                            <div class="col-md-8 margin-bottom10">
                                <multiselect :reset="reset_siblings" :current_student_id="form.student.spi_id" :student_category="student_category" @selectedsiblings="getSelectedData"></multiselect>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="col-md-5 label-color" v-if="form.student.enrolleeType != 'short_course'">
                    <div :class="checkErrorHeader('student.program')">
                        <div class="row">
                            <label for="student.program" class="control-label col-md-3 padding-left-zero">
                                Course: 
                            </label>
                            <div class="col-md-8 padding-left-zero margin-bottom10">
                                <select
                                    name="student.program" 
                                    id="program" 
                                    class="form-control select-text-g" 
                                    v-model="form.student.program" 
                                    @change="selectProgram('program')"
                                >
                                    <option value="" selected disabled>Select Program</option>
                                    <option v-for="program in programs" :value="program.prog_name">@{{program.prog_name}}</option>
                                </select>
                                <span class="help-block" v-if="form.errors.has('student.program')" v-text="form.errors.get('student.program')"></span>
                            </div>
                        </div>
                    </div>
                    <div :class="checkErrorHeader('student.major')">
                        <div class="row">
                            <label for="student.major" class="control-label col-md-3 padding-left-zero">
                                Major: 
                            </label>
                            <div class="col-md-8 padding-left-zero margin-bottom10">
                                <select 
                                    name="major" 
                                    id="major" 
                                    class="form-control select-text-g" 
                                    v-model=form.student.major
                                >
                                    <option value="" selected disabled>Select Major</option>
                                    <option v-for="major in majors" 
                                        :value="major.major" 
                                        v-text="major.major"
                                    ></option>
                                </select>
                                <span class="help-block" v-if="form.errors.has('student.major')" v-text="form.errors.get('student.major')"></span>
                            </div>
                        </div>
                    </div>
                    <div :class="checkErrorHeader('student.scholarship')">
                        <div class="row">
                            <label for="student.scholarship" class="control-label col-md-3 padding-left-zero">
                                Scholarship: 
                            </label>
                            <div class="col-md-8 padding-left-zero margin-bottom10">
                                <select 
                                    name="form.student.sl_id" 
                                    id="form.student.sl_id" 
                                    class="form-control select-text-g" 
                                    v-model=form.student.sl_id
                                >
                                    <option value="" selected>Select Scholarship</option>
                                    @foreach($scholarships as $scholarship)
                                        <option value="{{ $scholarship->sl_id }}">{{ $scholarship->scholarship_type }}</option>
                                    @endforeach
                                    
                                </select>
                                <!-- <span class="help-block" v-if="form.errors.has('student.major')" v-text="form.errors.get('student.major')"></span> -->
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<br>
	<br>
</div>