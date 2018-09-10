<div :class="checkErrorHeader('mother.lname')">
    <div class="row">
        <label for="mother.lname" class="control-label col-md-4">
            Last name: 
        </label>
        <div :class="checkErrorBody('mother.lname')">
            <input type="text"
                :recordDataName="recordDataName('lname', 'mother')" 
                name="mother.lname" 
                v-model="form.mother.lname" 
                class="form-control select-text-g"
                :id="form.mother.lname" 
            >
            <span class="help-block" v-if="form.errors.has('mother.lname')" v-text="form.errors.get('mother.lname')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('mother.fname')">
    <div class="row">
        <label for="mother.fname" class="control-label col-md-4">
            First name: 
        </label>
        <div :class="checkErrorBody('mother.fname')">
            <input type="text" 
                :recordDataName="recordDataName('fname', 'mother')"
                name="mother.fname" 
                v-model="form.mother.fname" 
                class="form-control select-text-g"
                :id="form.mother.fname" 
            >
            <span class="help-block" v-if="form.errors.has('mother.fname')" v-text="form.errors.get('mother.fname')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('mother.mname')">
    <div class="row">
        <label for="mother.mname" class="control-label col-md-4">
            Middle name: 
        </label>
        <div :class="checkErrorBody('mother.mname')">
            <input type="text" 
                :recordDataName="recordDataName('mname', 'mother')" 
                name="mother.mname" 
                v-model="form.mother.mname" 
                class="form-control select-text-g"
                :id="form.mother.mname" 
            >
            <span class="help-block" v-if="form.errors.has('mother.mname')" v-text="form.errors.get('mother.mname')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('mother.suffix')">
    <div class="row">
        <label for="mother.suffix" class="control-label col-md-4">
            Suffix
        </label>
        <div :class="checkErrorBody('mother.suffix')">
            <select name="mother.suffix" 
                :recordDataName="recordDataName('suffix', 'mother')"
                id="" 
                class="form-control select-text-g xlarge-select"
                v-model="form.mother.suffix" 
            >
                <option value="">Select Suffix</option>
                @if(count($suffix))
                    @foreach($suffix as $value)
                        <option value="{{$value->id}}">{{$value->value}}</option>
                    @endforeach
                @endif
                
            </select>
            <span class="help-block" v-if="form.errors.has('mother.suffix')" v-text="form.errors.get('mother.suffix')"></span>
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
                            <input type="radio" name="mother" value="yes" v-model="form.mother.use_present_address">
                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok check-color"></i></span>
                            <small>Yes</small>
                        </label>
                    </div>
                </li>
                <li>
                    <div class="radio checkbox1">
                        <label>
                            <input type="radio" name="mother" value="no" v-model="form.mother.use_present_address">
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

<template v-if="form.mother.use_present_address == 'no'">
    <!-- Present Address -->
    <div class="form-group margin-zero">
        {!! Form::label('Present Address', 'Present Address', ['class' => 'col-md-12']) !!}
    </div>

    @include('student_information.partials.address', ['address_type' => 'presentAddress', 'category' => 'mother'])
</template>
<div :class="checkErrorHeader('mother.birthdate')">
    <div class="row">
        <label for="mother.birthdate" class="control-label col-md-4">
            Birthdate: 
        </label>
        <div :class="checkErrorBody('mother.birthdate')">
            <input type="date"
                id="datepicker"
                :recordDataName="recordDataName('birthdate', 'mother')" 
                name="mother.birthdate" 
                v-model="form.mother.birthdate" 
                class="form-control select-text-g xlarge-select1"
            >
            <span class="help-block" v-if="form.errors.has('mother.birthdate')" v-text="form.errors.get('mother.birthdate')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('mother.mname')">
    <div class="row">
        <label for="mother.occupation" class="control-label col-md-4">
            Occupation: 
        </label>
        <div :class="checkErrorBody('mother.occupation')">
            <input type="text" 
                :recordDataName="recordDataName('occupation', 'mother')" 
                name="mother.occupation" 
                v-model="form.mother.occupation" 
                class="form-control select-text-g xlarge-select1"
                :id="form.mother.occupation" 
            >
            <span class="help-block" v-if="form.errors.has('mother.occupation')" v-text="form.errors.get('mother.occupation')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('mother.office_address')">
    <div class="row">
        <label for="mother.office_address" class="control-label col-md-4">
            Office Address: 
        </label>
        <div class="col-md-7 mb-25">
            <input type="text" 
                :recordDataName="recordDataName('office_address', 'mother')" 
                name="mother.office_address" 
                v-model="form.mother.office_address" 
                class="form-control select-text-g xlarge-select1"
                :id="form.mother.office_address" 
            >
            <span class="help-block" v-if="form.errors.has('mother.office_address')" v-text="form.errors.get('mother.office_address')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('mother.contact')">
    <div class="row">
        <label for="mother.contact" class="control-label col-md-4">
            Mobile No: 
        </label>
        <div class="col-md-7 margin-bottom10">
            <div  class="form-group" :class="{'has-error': form.errors.has('mother.contact.'+ index + '.phone_number')}" 
            v-for="(contact, index) in form.mother.contact">
                <template v-if="form.mother.enrolleeType != 'short_course'">
                    <div class="input-group contact-z-index">
                        <input type="text" minlength="1" maxlength="11" :name="'mother.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                            v-model="contact.phone_number">
                        <div class="input-group-addon add-field" v-if="index > 0" @click="removeContactNumber('mother')">
                            <a>
                                <span class="glyphicon glyphicon-minus"></span>
                            </a>
                        </div>
                        <div class="input-group-addon add-field" @click="addContactNumber('mother')">
                            <a>
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <input type="number" :name="'mother.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                            v-model="contact.phone_number">
                </template>
                <span class="help-block" v-if="form.errors.has('mother.contact.'+ index + '.phone_number')" v-text="form.errors.get('mother.contact.'+ index + '.phone_number')"></span>
            </div>
        </div>
    </div>
</div>



<div :class="checkErrorHeader('mother.telephone')">
    <div class="row">
        <label for="mother.telephone" class="control-label col-md-4">
            Telephone No: 
        </label>
        <div class="col-md-7 margin-bottom10">
            <div  class="form-group" :class="{'has-error': form.errors.has('mother.telephone.'+ index + '.telephone_number')}" 
            v-for="(telephone, index) in form.mother.telephone">
                <template v-if="form.mother.enrolleeType != 'short_course'">
                    <div class="input-group contact-z-index">
                        <input type="text" :name="'mother.telephone.'+ index + '.telephone_number'" class="form-control select-text-g" 
                            v-model="telephone.telephone_number">
                        <div class="input-group-addon add-field" v-if="index > 0" @click="removeTelephoneNumber('mother')">
                            <a>
                                <span class="glyphicon glyphicon-minus"></span>
                            </a>
                        </div>
                        <div class="input-group-addon add-field" @click="addTelephoneNumber('mother')">
                            <a>
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <input type="number" :name="'mother.telephone.'+ index + '.telephone_number'" class="form-control select-text-g" 
                            v-model="telephone.telephone_number">
                </template>
                <span class="help-block" v-if="form.errors.has('mother.telephone.'+ index + '.telephone_number')" v-text="form.errors.get('mother.telephone.'+ index + '.telephone_number')"></span>
            </div>
        </div>
    </div>
</div>