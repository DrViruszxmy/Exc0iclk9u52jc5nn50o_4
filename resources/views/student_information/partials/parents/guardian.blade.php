<div class="row">
    <div class="col-md-6 label-color">

        <div :class="checkErrorHeader('guardian.relationship')">
            <div class="row">
                <label for="guardian.relationship" class="control-label col-md-4">
                    Relationship
                </label>
                <div :class="checkErrorBody('guardian.relationship')">
                    <select name="guardian.relationship" 
                        :recordDataName="recordDataName('rel_id', 'guardian')"
                        id="" 
                        class="form-control select-text-g xlarge-select"
                        v-model="form.guardian.rel_id" 
                        @change="changeRelationship(form.guardian.rel_id)"
                    >
                        <option value="" selected disabled>Select Relationship</option>
                        @if(count($relationship))
                            @foreach($relationship as $value)
                                <option value="{{$value->value}}">{{strtoupper($value->value)}}</option>
                            @endforeach
                        @endif
                        <option value="other">Other</option>
                    </select>
                    
                    <template v-if="form.guardian.rel_id == 'other'">
                        <input type="text"
                            :recordDataName="recordDataName('new_relation', 'guardian')"
                            name="guardian.relationship"
                            v-model="form.guardian.new_relation" 
                            class="form-control select-text-g other-r"
                            placeholder="Please spicify" 
                        >
                    </template>
                    <span class="help-block" v-if="form.errors.has('guardian.relationship')" v-text="form.errors.get('guardian.relationship')"></span>
                </div>
            </div>
        </div>

        <div :class="checkErrorHeader('guardian.lname')">
            <div class="row">
                <label for="guardian.lname" class="control-label col-md-4">
                    Last name: 
                </label>
                <div :class="checkErrorBody('guardian.lname')">
                    <input type="text"
                        :recordDataName="recordDataName('lname', 'guardian')" 
                        name="guardian.lname" 
                        v-model="form.guardian.lname" 
                        class="form-control select-text-g"
                        :id="form.guardian.lname" 
                        :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                    >
                    <span class="help-block" v-if="form.errors.has('guardian.lname')" v-text="form.errors.get('guardian.lname')"></span>
                </div>
            </div>
        </div>

        <div :class="checkErrorHeader('guardian.fname')">
            <div class="row">
                <label for="guardian.fname" class="control-label col-md-4">
                    First name: 
                </label>
                <div :class="checkErrorBody('guardian.fname')">
                    <input type="text" 
                        :recordDataName="recordDataName('fname', 'guardian')"
                        name="guardian.fname" 
                        v-model="form.guardian.fname" 
                        class="form-control select-text-g"
                        :id="form.guardian.fname" 
                        :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                    >
                    <span class="help-block" v-if="form.errors.has('guardian.fname')" v-text="form.errors.get('guardian.fname')"></span>
                </div>
            </div>
        </div>

        <div :class="checkErrorHeader('guardian.mname')">
            <div class="row">
                <label for="guardian.mname" class="control-label col-md-4">
                    Middle name: 
                </label>
                <div :class="checkErrorBody('guardian.mname')">
                    <input type="text" 
                        :recordDataName="recordDataName('mname', 'guardian')" 
                        name="guardian.mname" 
                        v-model="form.guardian.mname" 
                        class="form-control select-text-g"
                        :id="form.guardian.mname" 
                        :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                    >
                    <span class="help-block" v-if="form.errors.has('guardian.mname')" v-text="form.errors.get('guardian.mname')"></span>
                </div>
            </div>
        </div>

        <div :class="checkErrorHeader('guardian.suffix')">
            <div class="row">
                <label for="guardian.suffix" class="control-label col-md-4">
                    Suffix
                </label>
                <div :class="checkErrorBody('guardian.suffix')">
                    <select name="guardian.suffix" 
                        :recordDataName="recordDataName('suffix', 'guardian')"
                        id="" 
                        class="form-control select-text-g xlarge-select"
                        v-model="form.guardian.suffix" 
                        :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                    >
                        <option value="">Select Suffix</option>
                        @if(count($suffix))
                            @foreach($suffix as $value)
                                <option value="{{$value->id}}">{{$value->value}}</option>
                            @endforeach
                        @endif
                        
                    </select>
                    <span class="help-block" v-if="form.errors.has('guardian.suffix')" v-text="form.errors.get('guardian.suffix')"></span>
                </div>
            </div>
        </div>

        <div :class="checkErrorHeader('guardian.birthdate')">
            <div class="row">
                <label for="guardian.birthdate" class="control-label col-md-4">
                    Birthdate: 
                </label>
                <div :class="checkErrorBody('guardian.birthdate')">
                    <input type="date"
                        id="datepicker"
                        :recordDataName="recordDataName('birthdate', 'guardian')" 
                        name="guardian.birthdate" 
                        v-model="form.guardian.birthdate" 
                        class="form-control select-text-g xlarge-select1" 
                        :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                    >
                    <span class="help-block" v-if="form.errors.has('guardian.birthdate')" v-text="form.errors.get('guardian.birthdate')"></span>
                </div>
            </div>
        </div>

        <div :class="checkErrorHeader('guardian.occupation')">
            <div class="row">
                <label for="guardian.occupation" class="control-label col-md-4">
                    Occupation: 
                </label>
                <div :class="checkErrorBody('guardian.occupation')">
                    <input type="text" 
                        :recordDataName="recordDataName('occupation', 'guardian')" 
                        name="guardian.occupation" 
                        v-model="form.guardian.occupation" 
                        class="form-control select-text-g xlarge-select1"
                        :id="form.guardian.occupation" 
                        :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                    >
                    <span class="help-block" v-if="form.errors.has('guardian.occupation')" v-text="form.errors.get('guardian.occupation')"></span>
                </div>
            </div>
        </div>

        <div :class="checkErrorHeader('guardian.office_address')">
            <div class="row">
                <label for="guardian.office_address" class="control-label col-md-4">
                    Office Address: 
                </label>
                <div :class="checkErrorBody('guardian.office_address')">
                    <input type="text" 
                        :recordDataName="recordDataName('office_address', 'guardian')" 
                        name="guardian.office_address" 
                        v-model="form.guardian.office_address" 
                        class="form-control select-text-g"
                        :id="form.guardian.office_address" 
                        :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                    >
                    <span class="help-block" v-if="form.errors.has('guardian.office_address')" v-text="form.errors.get('guardian.office_address')"></span>
                </div>
            </div>
        </div>


        <div :class="checkErrorHeader('guardian.contact')">
            <div class="row">
                <label for="guardian.contact" class="control-label col-md-4">
                    Mobile No: 
                </label>
                <div class="col-md-7 margin-bottom10">
                    <div  class="form-group" :class="{'has-error': form.errors.has('guardian.contact.'+ index + '.phone_number')}" 
                    v-for="(contact, index) in form.guardian.contact">
                        <template v-if="form.guardian.enrolleeType != 'short_course'">
                            <div class="input-group contact-z-index">
                                <input type="text" minlength="1" maxlength="11" :name="'guardian.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                                    minlength="1" maxlength="11"
                                    v-model="contact.phone_number" 
                                    :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                                    >
                                <div class="input-group-addon add-field" v-if="index > 0" @click="removeContactNumber('guardian')">
                                    <a>
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                </div>
                                <div class="input-group-addon add-field" @click="addContactNumber('guardian')">
                                    <a>
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <input type="number" :name="'guardian.contact.'+ index + '.phone_number'" class="form-control select-text-g" 
                                    v-model="contact.phone_number" 
                                    :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'"
                                    >
                        </template>
                        <span class="help-block" v-if="form.errors.has('guardian.contact.'+ index + '.phone_number')" v-text="form.errors.get('guardian.contact.'+ index + '.phone_number')"></span>
                    </div>
                </div>
            </div>
        </div>


        <div :class="checkErrorHeader('guardian.telephone')">
            <div class="row">
                <label for="guardian.telephone" class="control-label col-md-4">
                    Telephone No: 
                </label>
                <div class="col-md-7 margin-bottom10">
                    <div  class="form-group" :class="{'has-error': form.errors.has('guardian.telephone.'+ index + '.telephone_number')}" 
                    v-for="(telephone, index) in form.guardian.telephone">
                        <template v-if="form.guardian.enrolleeType != 'short_course'">
                            <div class="input-group contact-z-index">
                                <input type="text" :name="'guardian.telephone.'+ index + '.telephone_number'" class="form-control select-text-g" 
                                    v-model="telephone.telephone_number" :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'">
                                <div class="input-group-addon add-field" v-if="index > 0" @click="removeTelephoneNumber('guardian')">
                                    <a>
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </a>
                                </div>
                                <div class="input-group-addon add-field" @click="addTelephoneNumber('guardian')">
                                    <a>
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <input type="number" :name="'guardian.telephone.'+ index + '.telephone_number'" class="form-control select-text-g" 
                                    v-model="telephone.telephone_number" :disabled="form.guardian.rel_id == 'Father' || form.guardian.rel_id == 'Mother'">
                        </template>
                        <span class="help-block" v-if="form.errors.has('guardian.telephone.'+ index + '.telephone_number')" v-text="form.errors.get('guardian.telephone.'+ index + '.telephone_number')"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>















    <div class="col-md-6 label-color">
        <!-- Present Address -->
        <div class="form-group margin-zero">
            {!! Form::label('Present Address', 'Present Address', ['class' => 'col-md-12']) !!}
        </div>

        @include('student_information.partials.parents.guardian_address', ['address_type' => 'presentAddress', 'category' => 'guardian'])
    </div>
</div>