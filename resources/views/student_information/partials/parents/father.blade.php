<div :class="checkErrorHeader('father.lname')">
    <div class="row">
        <label for="father.lname" class="control-label col-md-4">
            Last name: 
        </label>
        <div :class="checkErrorBody('father.lname')">
            <input type="text"
                :recordDataName="recordDataName('lname', 'father')" 
                name="father.lname" 
                v-model="form.father.lname" 
                class="form-control select-text-g"
                :id="form.father.lname" 
            >
            <span class="help-block" v-if="form.errors.has('father.lname')" v-text="form.errors.get('father.lname')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('father.fname')">
    <div class="row">
        <label for="father.fname" class="control-label col-md-4">
            First name: 
        </label>
        <div :class="checkErrorBody('father.fname')">
            <input type="text" 
                :recordDataName="recordDataName('fname', 'father')"
                name="father.fname" 
                v-model="form.father.fname" 
                class="form-control select-text-g"
                :id="form.father.fname" 
            >
            <span class="help-block" v-if="form.errors.has('father.fname')" v-text="form.errors.get('father.fname')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('father.mname')">
    <div class="row">
        <label for="father.mname" class="control-label col-md-4">
            Middle name: 
        </label>
        <div :class="checkErrorBody('father.mname')">
            <input type="text" 
                :recordDataName="recordDataName('mname', 'father')" 
                name="father.mname" 
                v-model="form.father.mname" 
                class="form-control select-text-g"
                :id="form.father.mname" 
            >
            <span class="help-block" v-if="form.errors.has('father.mname')" v-text="form.errors.get('father.mname')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('father.suffix')">
    <div class="row">
        <label for="father.suffix" class="control-label col-md-4">
            Suffix
        </label>
        <div :class="checkErrorBody('father.suffix')">
            <select name="father.suffix" 
                :recordDataName="recordDataName('suffix', 'father')"
                id="" 
                class="form-control select-text-g xlarge-select"
                v-model="form.father.suffix" 
            >
                <option value="">Select Suffix</option>
                @if(count($suffix))
                    @foreach($suffix as $value)
                        <option value="{{$value->id}}">{{$value->value}}</option>
                    @endforeach
                @endif
                
            </select>
            <span class="help-block" v-if="form.errors.has('father.suffix')" v-text="form.errors.get('father.suffix')"></span>
        </div>
    </div>
</div>

<div class="custom-form-group">
    <div class="row">
        <label for="student.suffix" class="control-label col-md-4">
            Same as personal present address?
        </label>
        <div class="col-md-6">
            <br>
            <ul class="list-inline">
                <li>
                    <div class="radio checkbox1">
                        <label>
                            <input type="radio" name="father" value="yes" v-model="form.father.use_present_address">
                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok check-color"></i></span>
                            <small>Yes</small>
                        </label>
                    </div>
                </li>
                <li>
                    <div class="radio checkbox1">
                        <label>
                            <input type="radio" name="father" value="no" v-model="form.father.use_present_address">
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

<template v-if="form.father.use_present_address == 'no'">
    <!-- Present Address -->
    <div class="form-group margin-zero">
        {!! Form::label('Present Address', 'Present Address', ['class' => 'col-md-12']) !!}
    </div>

    @include('student_information.partials.address', ['address_type' => 'presentAddress', 'category' => 'father'])
</template>

<div :class="checkErrorHeader('father.birthdate')">
    <div class="row">
        <label for="father.birthdate" class="control-label col-md-4">
            Birthdate: 
        </label>
        <div :class="checkErrorBody('father.birthdate')">
            <input type="date"
                id="datepicker"
                :recordDataName="recordDataName('birthdate', 'father')" 
                name="father.birthdate" 
                v-model="form.father.birthdate" 
                class="form-control select-text-g xlarge-select1"
            >
            <span class="help-block" v-if="form.errors.has('father.birthdate')" v-text="form.errors.get('father.birthdate')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('father.occupation')">
    <div class="row">
        <label for="father.occupation" class="control-label col-md-4">
            Occupation: 
        </label>
        <div class="col-md-7 mb-25">
            <input type="text" 
                :recordDataName="recordDataName('occupation', 'father')" 
                name="father.occupation" 
                v-model="form.father.occupation" 
                class="form-control select-text-g xlarge-select1"
                :id="form.father.occupation" 
            >
            <span class="help-block" v-if="form.errors.has('father.occupation')" v-text="form.errors.get('father.occupation')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('father.office_address')">
    <div class="row">
        <label for="father.office_address" class="control-label col-md-4">
            Office Address: 
        </label>
        <div class="col-md-7 mb-25">
            <input type="text" 
                :recordDataName="recordDataName('office_address', 'father')" 
                name="father.office_address" 
                v-model="form.father.office_address" 
                class="form-control select-text-g xlarge-select1"
                :id="form.father.office_address" 
            >
            <span class="help-block" v-if="form.errors.has('father.office_address')" v-text="form.errors.get('father.office_address')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('father.contact')">
    <div class="row">
        <label for="father.contact" class="control-label col-md-4">
            Mobile No: 
        </label>
        <div class="col-md-7 margin-bottom10">
            <div  class="form-group" :class="{'has-error': form.errors.has('father.contact.'+ index + '.phone_number')}" 
            v-for="(contact, index) in form.father.contact">
                <template v-if="form.father.enrolleeType != 'short_course'">
                    <div class="input-group contact-z-index">
                        <input type="text" minlength="1" maxlength="11" :name="'father.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                            v-model="contact.phone_number">
                        <div class="input-group-addon add-field" v-if="index > 0" @click="removeContactNumber('father')">
                            <a>
                                <span class="glyphicon glyphicon-minus"></span>
                            </a>
                        </div>
                        <div class="input-group-addon add-field" @click="addContactNumber('father')">
                            <a>
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <input type="number" :name="'father.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                            v-model="contact.phone_number">
                </template>
                <span class="help-block" v-if="form.errors.has('father.contact.'+ index + '.phone_number')" v-text="form.errors.get('father.contact.'+ index + '.phone_number')"></span>
            </div>
        </div>
    </div>
</div>


<div :class="checkErrorHeader('father.telephone')">
    <div class="row">
        <label for="father.telephone" class="control-label col-md-4">
            Telephone No: 
        </label>
        <div class="col-md-7 margin-bottom10">
            <div  class="form-group" :class="{'has-error': form.errors.has('father.telephone.'+ index + '.telephone_number')}" 
            v-for="(telephone, index) in form.father.telephone">
                <template v-if="form.father.enrolleeType != 'short_course'">
                    <div class="input-group contact-z-index">
                        <input type="text" :name="'father.telephone.'+ index + '.telephone_number'" class="form-control select-text-g" 
                            v-model="telephone.telephone_number">
                        <div class="input-group-addon add-field" v-if="index > 0" @click="removeTelephoneNumber('father')">
                            <a>
                                <span class="glyphicon glyphicon-minus"></span>
                            </a>
                        </div>
                        <div class="input-group-addon add-field" @click="addTelephoneNumber('father')">
                            <a>
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <input type="text" :name="'father.telephone.'+ index + '.telephone_number'" class="form-control select-text-g" 
                            v-model="telephone.telephone_number">
                </template>
                <span class="help-block" v-if="form.errors.has('father.telephone.'+ index + '.telephone_number')" v-text="form.errors.get('father.telephone.'+ index + '.telephone_number')"></span>
            </div>
        </div>
    </div>
</div>