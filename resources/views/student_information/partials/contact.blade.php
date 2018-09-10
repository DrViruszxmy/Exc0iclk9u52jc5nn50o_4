<div :class="checkErrorHeader('{{$phone_array}}.index.{{$phone_type}}')">
    <div class="row">
        <label :for="{{$name}}" class="control-label {{$offset}}">
            {{$label}}
        </label>
        <div :class="checkErrorBody('{{$phone_array}}.index.{{$phone_type}}')">
            <{{$phone_type}} v-for="(field, index) in form.{{$phone_array}}" :key="index">
    
            <div :class="checkInputError('{{$phone_array}}.'+index+'.{{$phone_type}}')">
                
                    <input type="{{$type or 'number'}}" 
                        :name="'form.{{$phone_array}}['+index+'][{{$phone_type}}]'" 
                        v-model="form.{{$phone_array}}[index].{{$phone_type}}" 
                        class="form-control select-text-g {{$class}}"
                        :id="{{$name}}" 
                        @keydown="form.errors.clear('{{$phone_array}}.index.{{$phone_type}}')"
                    >
                    
                
                <div class="input-group-addon add-field">
                    <a @click="addForm('{{$phone_array or ''}}')"><span class="glyphicon glyphicon-plus"></span> </a>
                    <a v-if="form.{{$phone_array}}.length > 1" @click="removeForm('{{$phone_array or ''}}')"><span class="glyphicon glyphicon-minus"></span> </a>
                </div>

                
            </div>
            <span class="help-block red-font" v-if="form.errors.has('{{$phone_array}}.'+index+'.{{$phone_type}}')" v-text="form.errors.get('{{$phone_array}}.'+index+'.{{$phone_type}}')"></span>
            </{{$phone_type}}>
            
        </div>
    </div>
</div>