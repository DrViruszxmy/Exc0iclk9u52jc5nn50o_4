<select name="" class="studinfo-select" v-model='searchStudent.school_year' @change="resetForm()">
	<option value="" selected disabled>Select</option>
    @if(count($allYears))
        @foreach($allYears as $value)
            <option  value="{{$value->sch_year}}">{{$value->sch_year}}</option>
        @endforeach
    @endif
</select>