
<div :class="checkErrorHeader('{{$category}}.{{$address_type}}_country')">
    <div class="row">
        <label for="{{$category}}.country_id" class="control-label col-md-3 col-md-offset-1">
            Country
        </label>
        <div :class="checkErrorBody('{{$category}}.{{$address_type}}_country')">
            <select name="{{$category}}.country"
                :recordDataName="recordDataName('country_id')"
                id="" 
                class="form-control select-text-g xlarge-select"
                v-model="form.{{$category}}.{{$address_type}}.country_id" 
                @change="selectCountry($event, '{{$category}}', 'country', '{{$address_type}}')"
            >
                <option value="" selected>Select Country</option>
                @if(count($country))
                    @foreach($country as $value)
                        <option value="{{$value->id}}">{{$value->value}}</option>
                    @endforeach
                @endif
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.{{$address_type}}_country')" v-text="form.errors.get('{{$category}}.{{$address_type}}_country')"></span>
        </div>
    </div>
</div>

<div :class="checkErrorHeader('{{$category}}.reg_id')">
    <div class="row">
        <label for="{{$category}}.reg_id" class="control-label col-md-3 col-md-offset-1">
            Region
        </label>
        <div :class="checkErrorBody('{{$category}}.reg_id')">
            <select name="{{$category}}.reg_id" 
                :recordDataName="recordDataName('reg_id')"
                id="" 
                class="form-control select-text-g xlarge-select"
                v-model="form.{{$category}}.{{$address_type}}.reg_id" 
               @change="selectCountry($event, '{{$category}}', 'region', '{{$address_type}}')"
            >
                <option value="" selected>Select Region</option>
                <option v-for="location in address['{{$category}}']['{{$address_type}}'].regions" :value="location.reg_id" v-text="location.region_name"></option>
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.reg_id')" v-text="form.errors.get('{{$category}}.reg_id')"></span>
        </div>
    </div>
</div> 

<div :class="checkErrorHeader('{{$category}}.province_id')">
    <div class="row">
        <label for="{{$category}}.province_id" class="control-label col-md-3 col-md-offset-1">
            Province
        </label>
        <div :class="checkErrorBody('{{$category}}.province_id')">
            <select name="{{$category}}.province_id" 
                :recordDataName="recordDataName('province_id')"
                id="" 
                class="form-control select-text-g xlarge-select"
                v-model="form.{{$category}}.{{$address_type}}.province_id" 
               @change="selectCountry($event, '{{$category}}', 'prov', '{{$address_type}}')"
            >
                <option value="" selected>Select Province</option>
                <option v-for="location in address[ '{{$category}}' ][ '{{$address_type}}' ].provinces" :value="location.province_id" v-text="location.province_name"></option>
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.province_id')" v-text="form.errors.get('{{$category}}.province_id')"></span>
        </div>
    </div>
</div> 

<div :class="checkErrorHeader('{{$category}}.city_id')">
    <div class="row">
        <label for="{{$category}}.city_id" class="control-label col-md-3 col-md-offset-1">
            City/Municipality
        </label>
        <div :class="checkErrorBody('{{$category}}.city_id')">
            <select name="{{$category}}.city_id" 
                :recordDataName="recordDataName('city_id')"
                id="" 
                class="form-control select-text-g xlarge-select"
                v-model="form.{{$category}}.{{$address_type}}.city_id" 
                @change="selectCountry($event, '{{$category}}', 'city', '{{$address_type}}')"
            >
                <option value="" selected>Select City/Municipality</option>
                <option v-for="location in address['{{$category}}'][ '{{$address_type}}' ].cities" :value="location.city_id" v-text="location.city_name"></option>
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.city_id')" v-text="form.errors.get('{{$category}}.city_id')"></span>
        </div>
    </div>
</div> 

<div :class="checkErrorHeader('{{$category}}.province_id')">
    <div class="row">
        <label for="{{$category}}.province_id" class="control-label col-md-3 col-md-offset-1">
            Barangay
        </label>
        <div :class="checkErrorBody('{{$category}}.brgy_id')">
            <select name="{{$category}}.brgy_id" 
                :recordDataName="recordDataName('brgy_id')"
                id="" 
                class="form-control select-text-g xlarge-select"
                v-model="form.{{$category}}.{{$address_type}}.brgy_id" 
            >
                <option value="" selected>Select Barangay</option>
                <option v-for="location in address['{{$category}}'][ '{{$address_type}}' ].barangays" :value="location.brgy_id" v-text="location.brgy_name"></option>
            </select>
            <span class="help-block" v-if="form.errors.has('{{$category}}.brgy_id')" v-text="form.errors.get('{{$category}}.brgy_id')"></span>
        </div>
    </div>
</div> 

<div :class="checkErrorHeader('{{$category}}.street')">
    <div class="row">
        <label for="{{$category}}.street" class="control-label col-md-3 col-md-offset-1">
            Street: 
        </label>
        <div :class="checkErrorBody('{{$category}}.street')">
            <input type="text" 
                :recordDataName="recordDataName('street')"
                name="{{$category}}.street" 
                v-model="form.{{$category}}.{{$address_type}}.street" 
                class="form-control select-text-g xlarge-select"
                :id="form.{{$category}}.street" 
            >
            <span class="help-block" v-if="form.errors.has('{{$category}}.street')" v-text="form.errors.get('{{$category}}.street')"></span>
        </div>
    </div>
</div>