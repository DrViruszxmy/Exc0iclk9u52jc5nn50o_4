<header class='header-color'>
    <div class="row">
        <div class="col-sm-3 header-title">
            <p>Students Withdrawn</p>
        </div>
        <div class="col-md-8 col-md-offset-1">
            <div class="row">
                <div class="col-md-4 col-sm-4 padding-zero">
                    <div class="row">
                        <div class="col-md-6 padding-zero">
                            <p class="hidden-sm">School Level:</p>
                        </div>
                        <div class="col-md-4 padding-zero">
                            <select name="" class="studinfo-select" v-model="school_lvl" @change="studentsWithdrawn">
                                <option value="" selected disabled>Select</option>
                                <option value="Senior High">Senior High</option>
                                <option value="college">College</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5 padding-zero">
                    <div class="row">
                        <div class="col-md-6 padding-zero">
                            <p class="hidden-sm">Academic Year:</p>
                        </div>
                        <div class="col-md-6">
                            <select name="" class="studinfo-select" v-model="academic_year" @change="studentsWithdrawn">
                                <option value="" selected disabled>Select</option>
                                @if(count($school_years))
                                    @foreach($school_years as $value)
                                        <option  value="{{$value->sch_year}}">{{$value->sch_year}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 padding-zero">
                    <div class="row">
                        <div class="col-md-5">
                            <p class="hidden-sm">Semester:</p>
                        </div>
                        <div class="col-md-5">
                            <select name="semester" class="studinfo-select" v-model="semester" @change="studentsWithdrawn">
                                <option value="" selected disabled>Select</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<body>
    <div class="sh-dashboard-prev">
        <div v-show="isTable == false">
            <br>
            <line-chart :schools="withdrawSchools" :male="withdrawMaleChartCount" :female="withdrawFemaleChartCount" :ischangelog="ischangelog"></line-chart>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h3 class="text-center">Male Students: @{{ new_male }}</h3>
                </div>
                <div class="col-md-4">
                    <h3 class="text-center">Female Students: @{{ new_female }}</h3>
                </div>
                <div class="col-md-4">
                    <h3 class="text-center">Total Students: @{{ new_total }}</h3>
                </div>
            </div>
        </div>
        <template v-if="isTable == true">
            <div class="r-table-w">
                <template v-if="total_withdrawn_students.length > 0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-wrapper mt-10 mb-15">
                                <input type="text" class="form-control search-bar" id="tags" placeholder='Search'>
                            </div>
                        </div>
                    </div>
                </template>
                <!-- <template v-else>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <br>
                            <br>
                            <h2>No records found</h2>
                        </div>
                    </div>
                </template> -->
                <br>
                <br>
                <div class="row">
                    <div class="col-md-12" v-if="total_withdrawn_students.length > 0">
                        <div id="print-suben">
                            <div class="row" v-if="isPrint">
                                <div class="col-md-12 text-center head-color">
                                    <h2 class="margin-bottom-zero">ACLC College of Butuan City, Inc.</h2>
                                    <small>HDS Building JC Aquino, Butuan City</small>
                                    <h5 class="margin-zero">A.Y. : {{ $school_year }} / Sem: {{ $semester }}</h5>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <table class="table" width="100%" id="students-withdrawn-table">
                                <thead class="">
                                    <tr>
                                        <th class="sub-w35">Schools</th>
                                        <th class="text-center sub-w20">No. of Students</th>
                                        <th class="text-center sub-w20">Male</th>
                                        <th class="text-center">Female</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="total_withdrawn_student in total_withdrawn_students" v-cloak>
                                        <td>@{{ total_withdrawn_student['school_name'] }}</td>
                                        <td class="text-center">@{{ total_withdrawn_student['total'] }}</td>
                                        <td class="text-center">@{{ total_withdrawn_student['male'] }}</td>
                                        <td class="text-center">@{{ total_withdrawn_student['female'] }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr v-cloak>
                                        <td><h3 class="margin-zero">Total:</h3></td>
                                        <td class="text-center">
                                            <h4 class="margin-zero">@{{ new_total }}</h4>
                                        </td>
                                        <td class="text-center">
                                            <h4 class="margin-zero">@{{ new_male }}</h4>
                                        </td>
                                        <td class="text-center">
                                            <h4 class="margin-zero">@{{ new_female }}</h4>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</body>