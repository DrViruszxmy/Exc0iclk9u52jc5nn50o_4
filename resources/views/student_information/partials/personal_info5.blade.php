
<div class="educational-wrapper">
    <div class="nav-content-wrap">
        <h4>Personal Data</h4>
        <div class="bginfo">
            <div v-if="isLoading" class="gr-loader"> 
                <center>  
                <grid-loader></grid-loader>
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-md-6 label-color">
                        <div :class="checkErrorHeader('student.lname')">
                            <div class="row">
                                <label for="student.lname" class="control-label col-md-4">
                                    Last name: 
                                </label>
                                <div :class="checkErrorBody('student.lname')">
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
                                <label for="student.fname" class="control-label col-md-4">
                                    First name: 
                                </label>
                                <div :class="checkErrorBody('student.fname')">
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
                                <label for="student.mname" class="control-label col-md-4">
                                    Middle name: 
                                </label>
                                <div :class="checkErrorBody('student.mname')">
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
                                <label for="student.suffix" class="control-label col-md-4">
                                    Suffix
                                </label>
                                <div :class="checkErrorBody('student.suffix')">
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

                        <!-- Present Address -->
                        <div class="form-group margin-zero">
                            {!! Form::label('Present Address', 'Present Address', ['class' => 'col-md-12']) !!}
                        </div>
                        
                        @include('student_information.partials.address', ['address_type' => 'presentAddress', 'category' => 'student'])
                        
                        <div :class="checkErrorHeader('student.cit_id')">
                            <div class="row">
                                <label for="student.cit_id" class="control-label col-md-4">
                                    Citizenship
                                </label>
                                <div :class="checkErrorBody('student.cit_id')">
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
        
                        <div :class="checkErrorHeader('student.height')">
                            <div class="row">
                                <label for="student.height" class="control-label col-md-4">
                                    Height (cm): 
                                </label>
                                <div :class="checkErrorBody('student.height')">
                                    <input type="number"
                                        :recordDataName="recordDataName('height')" 
                                        name="student.height" 
                                        v-model="form.student.height" 
                                        class="form-control select-text-g xlarge-select"
                                        :id="form.student.height" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('student.height')" v-text="form.errors.get('student.height')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('student.weight')">
                            <div class="row">
                                <label for="student.weight" class="control-label col-md-4">
                                    Weight (kg): 
                                </label>
                                <div :class="checkErrorBody('student.weight')">
                                    <input type="number"
                                        :recordDataName="recordDataName('weight')" 
                                        name="student.weight" 
                                        v-model="form.student.weight" 
                                        class="form-control select-text-g xlarge-select"
                                        :id="form.student.weight" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('student.weight')" v-text="form.errors.get('student.weight')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div :class="checkErrorHeader('student.blood_type')">
                            <div class="row">
                                <label for="student.suffix" class="control-label col-md-4">
                                    Blood Type
                                </label>
                                <div :class="checkErrorBody('student.blood_type')">
                                    <select name="student.blood_type" 
                                        :recordDataName="recordDataName('blood_type')"
                                        id="" 
                                        class="form-control select-text-g medium-select"
                                        v-model="form.student.blood_type" 
                                    >
                                        <option value="">Select Blood Type</option>
                                        @if(count($blood_type))
                                            @foreach($blood_type as $value)
                                                <option value="{{$value->id}}">{{$value->value}}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                    <span class="help-block" v-if="form.errors.has('student.blood_type')" v-text="form.errors.get('student.blood_type')"></span>
                                </div>
                            </div>
                        </div>

    <!-- 
                    
                            @include('student_information/partials/contact', [
                                'phone_type' => 'email',
                                'phone_array' => 'student_email',
                                'type' => 'text',
                                'label' => 'Email: ',
                                'name' => "'form.student.weight'",
                                'class' => '',
                                'offset' => 'col-md-4'
                            ])
                        
                            @include('student_information/partials/contact', [
                                'phone_type' => 'telephone_number',
                                'phone_array' => 'student_telephone_number',
                                'label' => 'Telephone Number: ',
                                'name' => "'form.student.weight'",
                                'class' => '',
                                'offset' => 'col-md-4'
                            ])
                        
                            @include('student_information/partials/contact', [
                                'phone_type' => 'phone_number',
                                'phone_array' => 'student_phone_number',
                                'label' => 'Cellphone Number: ',
                                'name' => "'form.student.weight'",
                                'class' => '',
                                'offset' => 'col-md-4'
                            ]) -->
                    </div>
                    <!-- ***************************************** end of 1st column **************************************************** -->
                    <div class="col-md-6 label-color">
                        <div :class="checkErrorHeader('student.birthdate')">
                            <div class="row">
                                <label for="student.birthdate" class="control-label col-md-4">
                                    Birthdate: 
                                </label>
                                <div :class="checkErrorBody('student.birthdate')">
                                    <input type="date"
                                        id="datepicker"
                                        :recordDataName="recordDataName('birthdate')" 
                                        name="student.birthdate" 
                                        v-model="form.student.birthdate" 
                                        class="form-control select-text-g xlarge-select1"
                                    >
                                    <span class="help-block" v-if="form.errors.has('student.birthdate')" v-text="form.errors.get('student.birthdate')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('student.birthplace')">
                            <div class="row">
                                <label for="student.birthplace" class="control-label col-md-4">
                                    Birthplace: 
                                </label>
                                <div :class="checkErrorBody('student.birthplace')">
                                    <input type="text"
                                        :recordDataName="recordDataName('birthplace')" 
                                        name="student.birthplace" 
                                        v-model="form.student.birthplace" 
                                        class="form-control select-text-g xlarge-select1"
                                        :id="form.student.birthplace" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('student.birthplace')" v-text="form.errors.get('student.birthplace')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div :class="checkErrorHeader('student.gender')">
                            <div class="row">
                                <label for="student.suffix" class="control-label col-md-4">
                                    Gender
                                </label>
                                <div :class="checkErrorBody('student.gender')">
                                    <select name="student.gender" 
                                        :recordDataName="recordDataName('gender')"
                                        id="" 
                                        class="form-control select-text-g medium-select"
                                        v-model="form.student.gender" 
                                    >
                                        <option value="" selected disabled>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span class="help-block" v-if="form.errors.has('student.gender')" v-text="form.errors.get('student.gender')"></span>
                                </div>
                            </div>
                        </div>

                        <div :class="checkErrorHeader('student.civ_status')">
                            <div class="row">
                                <label for="student.suffix" class="control-label col-md-4">
                                    Civil Status
                                </label>
                                <div :class="checkErrorBody('student.civ_status')">
                                    <select name="student.civ_status" 
                                        :recordDataName="recordDataName('civ_status')"
                                        id="" 
                                        class="form-control select-text-g xlarge-select"
                                        v-model="form.student.civ_status" 
                                    >
                                        <option value="" selected disabled>Select Civil Status</option>
                                        @if(count($civil_status))
                                            @foreach($civil_status as $value)
                                                <option value="{{$value->id}}">{{$value->value}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="help-block" v-if="form.errors.has('student.civ_status')" v-text="form.errors.get('student.civ_status')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="custom-form-group">
                            <div class="row">
                                <label for="student.suffix" class="control-label col-md-4">
                                    Use present address as your permanent address?
                                </label>
                                <div class="col-md-6">
                                    <br>
                                    <ul class="list-inline">
                                        <li>
                                            <div class="radio checkbox1">
                                                <label>
                                                    <input type="radio" name="personal" value="yes" v-model="form.student.use_present_address">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok check-color"></i></span>
                                                    <small>Yes</small>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio checkbox1">
                                                <label>
                                                    <input type="radio" name="personal" value="no" v-model="form.student.use_present_address">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok check-color"></i></span>
                                                    <small>No</small>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                    <span class="help-block" v-if="form.errors.has('student.civ_status')" v-text="form.errors.get('student.civ_status')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <template v-if="form.student.use_present_address == 'no'">
                            <!-- Permanent Address -->
                            <div class="form-group margin-zero">
                                <label for="permanent" class="control-label col-md-12">Permanent Address</label>
                            </div>

                           @include('student_information.partials.address', ['address_type' => 'permanentAddress', 'category' => 'student'])                            
                        </template>
                        
                        <div :class="checkErrorHeader('student.religion')">
                            <div class="row">
                                <label for="student.religion" class="control-label col-md-4">
                                    Religion: 
                                </label>
                                <div :class="checkErrorBody('student.religion')">
                                    <input type="text"
                                        :recordDataName="recordDataName('religion')" 
                                        name="student.religion" 
                                        v-model="form.student.religion" 
                                        class="form-control select-text-g xlarge-select1"
                                        :id="form.student.religion" 
                                    >
                                    <span class="help-block" v-if="form.errors.has('student.religion')" v-text="form.errors.get('student.religion')"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div :class="checkErrorHeader('student.contact')">
                            <div class="row">
                                <label for="student.contact" class="control-label col-md-4">
                                    Contact No: 
                                </label>
                                <div class="col-md-7 margin-bottom10">
                                    <div  class="form-group" :class="{'has-error': form.errors.has('student.contact.'+ index + '.phone_number')}" 
                                    v-for="(contact, index) in form.student.contact">
                                        <template v-if="form.student.enrolleeType != 'short_course'">
                                            <div class="input-group contact-z-index">
                                                <input type="text" minlength="1" maxlength="11" :name="'student.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                                                    v-model="contact.phone_number">
                                                <div class="input-group-addon add-field" v-if="index > 0" @click="removeContactNumber('student')">
                                                    <a>
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                    </a>
                                                </div>
                                                <div class="input-group-addon add-field" @click="addContactNumber('student')">
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

                        <div :class="checkErrorHeader('student.email')">
                            <div class="row">
                                <label for="student.email" class="control-label col-md-4">
                                    Email: 
                                </label>
                                <div class="col-md-7 margin-bottom10">
                                    <div  class="form-group" :class="{'has-error': form.errors.has('student.email.'+ index + '.email')}" 
                                    v-for="(email, index) in form.student.email">
                                        <template v-if="form.student.enrolleeType != 'short_course'">
                                            <div class="input-group contact-z-index">
                                                <input type="email" :name="'student.email.'+ index + '.email'" class="form-control select-text-g" 
                                                    v-model="email.email">
                                                <div class="input-group-addon add-field" v-if="index > 0" @click="removeEmail">
                                                    <a>
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                    </a>
                                                </div>
                                                <div class="input-group-addon add-field" @click="addEmail">
                                                    <a>
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <input type="email" :name="'student.email.'+ index + '.email'" class="form-control select-text-g" 
                                                    v-model="email.email">
                                        </template>
                                        <span class="help-block" v-if="form.errors.has('student.email.'+ index + '.email')" v-text="form.errors.get('student.email.'+ index + '.email')"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div :class="checkErrorHeader('student.major')">
                            <div class="row">
                                <label for="student.major" class="control-label col-md-3 padding-right-zero">
                                    Email: 
                                </label>
                                <div class="col-md-8 margin-bottom10">
                                    <div  class="form-group" :class="{'has-error': form.errors.has('student.contact.'+ index + '.phone_number')}" 
                                    v-for="(contact, index) in form.student.contact">
                                        <template v-if="form.student.enrolleeType != 'short_course'">
                                            <div class="input-group contact-z-index">
                                                <input type="number" :name="'student.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
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
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

