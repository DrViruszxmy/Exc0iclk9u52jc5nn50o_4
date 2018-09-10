<div :class="checkErrorHeader('{{$category}}.'+schoolIndex+'.{{$address_type}}.country_id')">
    <div class="row">
        <label for="{{$category}}.country_id" class="control-label col-md-5">
            Country
        </label>
        <div class="col-md-6 margin-bottom10">
            <select 
                :name="'{{$category}}.'+schoolIndex+'.{{$address_type}}.country_id'"
                :recordDataName="recordDataName('country_id')"
                :id="schoolIndex" 
                class="form-control select-text-g"
                v-model="school.{{$address_type}}.country_id" 
                @change="selectCountry($event, '{{$category}}', 'country', '{{$address_type}}')"
            >
                <option value="" selected>Select Country</option>
                @if(count($country))
                    @foreach($country as $value)
                        <option value="{{$value->id}}">{{$value->value}}</option>
                    @endforeach
                @endif
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.'+schoolIndex+'.{{$address_type}}.country_id')" v-text="form.errors.get('{{$category}}.'+schoolIndex+'.{{$address_type}}.country_id')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('{{$category}}.'+schoolIndex+'.{{$address_type}}.reg_id')">
    <div class="row">
        <label for="{{$category}}.reg_id" class="control-label col-md-5">
            Region
        </label>
        <div class="col-md-6 margin-bottom10">

            <select 
                :name="'{{$category}}.'+schoolIndex+'.{{$address_type}}.reg_id'" 
                :recordDataName="recordDataName('reg_id')"
                :id="schoolIndex" 
                class="form-control select-text-g"
                v-model="school.{{$address_type}}.reg_id" 
               @change="selectCountry($event, '{{$category}}', 'region', '{{$address_type}}')"
            >
                <option value="" selected>Select Region</option>
                <option v-for="location in address['{{$category}}']['{{$address_type}}'+schoolIndex].regions" :value="location.reg_id" v-text="location.region_name"></option>
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.'+schoolIndex+'.{{$address_type}}.reg_id')" v-text="form.errors.get('{{$category}}.'+schoolIndex+'.{{$address_type}}.reg_id')"></span>
        </div>
    </div>
</div> 

<div :class="checkErrorHeader('{{$category}}.'+schoolIndex+'.{{$address_type}}.province_id')">
    <div class="row">
        <label for="{{$category}}.province_id" class="control-label col-md-5">
            Province
        </label>
        <div class="col-md-6 margin-bottom10">
            <select 
                :name="'{{$category}}.'+schoolIndex+'.{{$address_type}}.province_id'"  
                :recordDataName="recordDataName('province_id')"
                :id="schoolIndex" 
                class="form-control select-text-g"
                v-model="school.{{$address_type}}.province_id" 
               @change="selectCountry($event, '{{$category}}', 'prov', '{{$address_type}}')"
            >
                <option value="" selected>Select Province</option>
                <option v-for="location in address['{{$category}}']['{{$address_type}}'+schoolIndex].provinces" :value="location.province_id" v-text="location.province_name"></option>
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.'+schoolIndex+'.{{$address_type}}.province_id')" v-text="form.errors.get('{{$category}}.'+schoolIndex+'.{{$address_type}}.province_id')"></span>
        </div>
    </div>
</div> 

<div :class="checkErrorHeader('{{$category}}.'+schoolIndex+'.{{$address_type}}.city_id')">
    <div class="row">
        <label for="{{$category}}.city_id" class="control-label col-md-5">
            City/Municipality
        </label>
        <div class="col-md-6 margin-bottom10">
            <select 
                :name="'{{$category}}.'+schoolIndex+'.{{$address_type}}.city_id'"  
                :recordDataName="recordDataName('city_id')"
                :id="schoolIndex" 
                class="form-control select-text-g"
                v-model="school.{{$address_type}}.city_id" 
                @change="selectCountry($event, '{{$category}}', 'city', '{{$address_type}}')"
            >
                <option value="" selected>Select City/Municipality</option>
                <option v-for="location in address['{{$category}}']['{{$address_type}}'+schoolIndex].cities" :value="location.city_id" v-text="location.city_name"></option>
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.'+schoolIndex+'.{{$address_type}}.city_id')" v-text="form.errors.get('{{$category}}.'+schoolIndex+'.{{$address_type}}.city_id')"></span>
        </div>
    </div>
</div> 

<div :class="checkErrorHeader('{{$category}}.'+schoolIndex+'.{{$address_type}}.brgy_id')">
    <div class="row">
        <label for="{{$category}}.province_id" class="control-label col-md-5">
            Barangay
        </label>
        <div class="col-md-6 margin-bottom10">
            <select 
                :name="'{{$category}}.'+schoolIndex+'.{{$address_type}}.brgy_id'"  
                :recordDataName="recordDataName('brgy_id')"
                :id="schoolIndex" 
                class="form-control select-text-g"
                v-model="school.{{$address_type}}.brgy_id" 
            >
                <option value="" selected>Select Barangay</option>
                <option v-for="location in address['{{$category}}']['{{$address_type}}'+schoolIndex].barangays" :value="location.brgy_id" v-text="location.brgy_name"></option>
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.'+schoolIndex+'.{{$address_type}}.brgy_id')" v-text="form.errors.get('{{$category}}.'+schoolIndex+'.{{$address_type}}.brgy_id')"></span>
        </div>
    </div>
</div> 

<div :class="checkErrorHeader('{{$category}}.'+schoolIndex+'.{{$address_type}}.street')">
    <div class="row">
        <label for="{{$category}}.street" class="control-label col-md-5">
            Street: 
        </label>
        <div class="col-md-6 margin-bottom10">
            <input type="text" 
                :name="'{{$category}}.'+schoolIndex+'.{{$address_type}}.street'"
                :recordDataName="recordDataName('street')"
                v-model="school.{{$address_type}}.street" 
                class="form-control select-text-g"
                :id="school.street" 
            >
            <span class="help-block" v-if="form.errors.has('{{$category}}.'+schoolIndex+'.{{$address_type}}.street')" v-text="form.errors.get('{{$category}}.'+schoolIndex+'.{{$address_type}}.street')"></span>
        </div>
    </div>
</div>
